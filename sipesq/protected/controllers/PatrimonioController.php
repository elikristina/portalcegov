<?php

class PatrimonioController extends Controller
{
	public $activeMenu = "Projetos";
	
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column_new';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				
			array('allow', // Autenticação via Sipesq
				'actions'=>array('admin','index'),
				'expression'=> function(){
						return Sipesq::isSupport();					
					}
			),
			
			array('allow', // Autenticação via ProjetoDespesa
					'actions'=>array('create'),
					'expression'=> function(){
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							//Carrega o patrimonio
							$despesa = ProjetoDespesa::model()->findByPk($id);
							$result =  $despesa->projeto->isMember(Yii::app()->user->getId());
							if($result ===true)
								return true;
							return false;
						}
						
					}
			),
			
			array('allow', // Autenticação via Patrimonio
					'actions'=>array('update', 'delete','view'),
					'expression'=> function(){
						
						if(isset($_GET['id'])){
							$id = $_GET['id'];
							//Carrega o patrimonio
							$patrimonio = Patrimonio::model()->findByPk($id);
							//verifica se o usuario tem permissao
							return $patrimonio->despesa->projeto->isMember(Yii::app()->user->getId());
						}
							
					}
			),

			/**
			*==============
			*Permissoes de GRUPO
			*==============
			*/

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 1);					
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('update', 'create'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 2);					
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'delete','admin'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 100);					
				}
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id - Identifica uma despesa de projeto 
	 */
	public function actionCreate($id)
	{
		$model=new Patrimonio;
		$model->logs = '';
		
		
		//Atribui ao modelo sua respectiva despesa
		$model->despesa = ProjetoDespesa::model()->findByPk($id);
		$model->cod_projeto_despesa = (int)$id;
		
		if($model->despesa == null){
			//não existe tal deespesa
			throw new CHttpException('404', 'Página não encontrada');
			Yii::log('Sistema não encontrou o ProjetoDespesa com identificador ' .$id);
		}
			
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patrimonio']))
		{
			$model->attributes=$_POST['Patrimonio'];
			if($model->save()){
				$model->log('CREATE');
				$this->redirect(array('view','id'=>$model->cod_patrimonio));
				
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Patrimonio']))
		{
			$model->attributes=$_POST['Patrimonio'];
			if($model->save()){
				$model->log('UPDATE');
				$this->redirect(array('view','id'=>$model->cod_patrimonio));
			}
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Patrimonio');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Patrimonio('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Patrimonio']))
			$model->attributes=$_GET['Patrimonio'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Patrimonio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='patrimonio-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	
}
