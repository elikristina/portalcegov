<?php

class RubricaController extends Controller
{
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view', 'jsonRubrica', 'help'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'updateCampo', 'createCampo', 'deleteCampo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
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
	 * 
	 * Enter description here ...
	 * @param unknown_type $id
	 */
	public function actionJsonRubrica($id){
		
		$rubrica = new Rubrica();
		$rubrica = $rubrica->findByPk($id);
		echo CJSON::encode($rubrica->campos);
		Yii::app()->end();
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		
		$model=new Rubrica;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Rubrica']))
		{
			
			$model->attributes=$_POST['Rubrica'];
			if($model->save()){
				
				//Salva os campos adicionais
				if(isset($_POST['Campo'])){
					foreach ($_POST['Campo'] as $cmp){
						$campo = new RubricaCampo();
						$campo->attributes=$cmp;
						$campo->cod_rubrica = $model->cod_rubrica;
						if(!$campo->save()){
							throw new CHttpException(500,'Não foi possível salvar o campo' .$campo->chave);
						} 
					}
				}
				
				//Redireciona
				$this->redirect(array('view','id'=>$model->cod_rubrica));
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

		if(isset($_POST['Rubrica']))
		{
			$model->attributes=$_POST['Rubrica'];
			if($model->save()){
				if(isset($_POST['Campo'])){
						foreach ($_POST['Campo'] as $cmp){
							$campo = new RubricaCampo();
							$campo->attributes=$cmp;
							$campo->cod_rubrica = $model->cod_rubrica;
							if(!$campo->save()){
								throw new CHttpException(500,'Não foi possível salvar o campo' .$campo->chave);
							} 
						}
					}
				
					$this->redirect(array('view','id'=>$model->cod_rubrica));
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
		$dataProvider=new CActiveDataProvider('Rubrica');
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Rubrica('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Rubrica']))
			$model->attributes=$_GET['Rubrica'];

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
		$model=Rubrica::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='rubrica-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Cria um novo campo para uma Rubrica
	 * @param integer $id - identificador da Rubrica
	 */
	public function actionCreateCampo($id){
		
	}
	
	/**
	 * 
	 * Atualiza um campo 
	 * @param integer $id - identificador do Campo
	 */
	public function actionUpdateCampo($id){
		
		$model=new RubricaCampo;
		$model = $model->findByPk($id);
		
		if(isset($_GET['layout']) && $_GET['layout'] == '0')
	    	$this->layout = false;

	    if(isset($_POST['RubricaCampo']))
	    {
	        $model->attributes=$_POST['RubricaCampo'];
	        if($model->save())
	        {
	            // form inputs are valid, do something here
	            	if($this->layout)
	            		$this->redirect(array('update','id'=>$model->cod_rubrica));
	            		
	            	$content = "<b>" .$model->chave ."</b>" ."<i>(" .$model->campos[$model->tipo] .")</i>";	
	            	echo $content;
	            	//echo CHtml::tag('li', array('class'=>'alert alert-info'), $content);
	            	Yii::app()->end();
	        }
	    }
	    
	    	
	    $this->render('_rubrica_campo',array('model'=>$model, 'container'=>'cmp-' .$model->cod_campo));
	}
	
	/**
	 *
	 * Deleta um campo
	 * @param integer $id - Identificador do campo
	 */
	public function actionDeleteCampo(){
		
		if(isset($_POST['id'])){
			$model = RubricaCampo::model()->findByPk($_POST['id']);
			
			if($model == null){
				throw new CHttpException(404,'The requested page does not exist.');
			}
			
			if($model->delete()){
				echo 'OK';
			}else{
				throw new CHttpException(500,'Não foi possível deletar o campo');
			}
			Yii::app()->end();
		}else{
			throw new CHttpException(404,'The requested page does not exist.');
		}		
		
	}

	public function actionHelp($id){
		$model = $this->loadModel($id);
		$this->layout = false;
		echo '<h5>' .$model->numero .' ' .$model->nome .'</h5>';
		echo '<p>' .$model->descricao .'</p>';
		Yii::app()->end();
	}


	public function actionToken($q){

	}
	
	
}
