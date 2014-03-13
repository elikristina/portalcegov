<?php

class AtividadeCategoriaController extends Controller
{
	protected $idMenu = 'menuGerencial';
	
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','listchildren','GetDescription'),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createfather','listchildren','GetDescription','admin','delete'),
				'expression'=>function(){
					if(Pessoa::getAccessLevel(Yii::app()->user->getId()) == Sipesq::ADMIN_PERMITION)
						return true;
					else
						return false;
				}
			),

			/**
			*==============
			* GRUPOS
			*==============
			*/

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create','update','createfather','listchildren','GetDescription','admin','delete'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('gerencial.categoria_atividade') >= 2);
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin','delete'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('gerencial.categoria_atividade') >= 100);
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
	 * Cria uma categoria Pai 
	 */
public function actionCreateFather($nome=null)
	{	/*
		$categorias = CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai is NULL')), 'cod_categoria', 'nome');
		foreach($categorias as $value=>$name){
			echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
		}
		*/
		
		if($nome != null){
			$categoria = new AtividadeCategoria();
			$categoria->nome = $nome;
			$categoria->descricao_relatorio = "Categoria Primária";
			//Salva a nova categoria pai
			if($categoria->save()){
				$categoria->cod_categoria_pai = $categoria->cod_categoria;
				if($categoria->save())
					echo CHtml::tag('option', array('value'=>$categoria->cod_categoria),CHtml::encode($categoria->nome),true);
			}
		}                   
                   
	}
	
	/**
	 * Lista todas as categorias secundarias de uma dada categoria
	 * @param int id
	 */
	public function actionListChildren($id=null)
	{	
		//echo CHtml::tag('option', array('value'=>null),CHtml::encode("Selecione uma Categoria Secundária"),true);
		
		if($id != null){
			$categorias = CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = ' .$id)), 'cod_categoria', 'nome');
			
			if(count($categorias) > 0){
			foreach($categorias as $value=>$name){
				echo CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
			}
			}else{
				$cPrimaria = $this->loadModel($id);
				echo CHtml::tag('option', array('value'=>$cPrimaria->cod_categoria),CHtml::encode($cPrimaria->nome),true);
			}
		}
			
	}
	
	public function actionGetDescription($id=null)
		{
			if($id != null){
				echo CHtml::encode($this->loadModel($id)->descricao_relatorio);
			}else echo " ";
		}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new AtividadeCategoria;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['AtividadeCategoria']))
		{
			$model->attributes=$_POST['AtividadeCategoria'];
			if($model->save())
				$this->redirect(array('index'));
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

		if(isset($_POST['AtividadeCategoria']))
		{
			$model->attributes=$_POST['AtividadeCategoria'];
			if($model->save())
				$this->redirect(array('index'));
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{ 
		
		
		$this->render('index',array(
			'categoriasPrimarias'=>AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')),
		));
		
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new AtividadeCategoria('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['AtividadeCategoria']))
			$model->attributes=$_GET['AtividadeCategoria'];

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
		$model=AtividadeCategoria::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='atividade-categoria-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
