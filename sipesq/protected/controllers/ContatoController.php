<?php

class ContatoController extends Controller
{
	public $activeMenu = "Acervo";
	
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index','view', 'search', 'admin','delete'),
				'expression'=>function($user, $rules){
					return (Sipesq::isSupport() || Sipesq::getPermition('acervo.contatos') >= 100);
				},
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('index','view', 'search'),
				'users'=>array('@'),
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
	 */
	public function actionCreate()
	{
		$model=new Contato;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contato']))
		{
			$model->attributes=$_POST['Contato'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_contato));
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

		if(isset($_POST['Contato']))
		{
			$model->attributes=$_POST['Contato'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_contato));
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
		$model = new Contato();
		
		$criteria = new CDbCriteria();
		if(isset($_GET['l'])){
			$criteria->addCondition("nome ILIKE '" .$_GET['l'] ."%'");
			$criteria->addCondition("nome ILIKE '" .strtolower($_GET['l']) ."%'");
		}
		
		$criteria->order = 'nome, email, telefone';
		
		$dataProvider=new CActiveDataProvider('Contato', array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	/**
	 * Lists all models.
	 */
	public function actionSearch($q=null)
	{
		
		
		
		$model=new Contato();
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contato']))
		  $model->attributes=$_GET['Contato'];
		  
		if($q != null){
				$model->nome = $q;
		}
		
		if(isset($_GET['Contato[nome]'])){
			$model->nome = $_GET['Contato[nome]'];
		}
		
		$criteria=new CDbCriteria;
		//$criteria->addSearchCondition('t.nome', $model->nome,true,'AND','ILIKE');
			$criteria->addCondition("nome ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("email ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("telefone ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("endereco ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("instituicao ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("website ILIKE '%" .$model->nome ."%'", 'OR');
			$criteria->addCondition("descricao ILIKE '%" .$model->nome ."%'", 'OR');
		$criteria->order = 't.nome';

    						
		$dataProvider=new CActiveDataProvider('Contato', array('criteria'=>$criteria,));
		$this->render('index',array(
			 
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	
/**
	 * Lists all models.
	 */
	public function actionSearch2($q=null)
	{
		
		
		
		$model=new Contato();
		$model->unsetAttributes();  // clear any default values
		
		$criteria=new CDbCriteria;
		$criteria->order = 't.nome';
		
		if($q != null){
			$model->nome = $q;
			$criteria->addCondition("nome ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("email ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("telefone ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("endereco ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("instituicao ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("website ILIKE '%" .$q ."%'", 'OR');
			$criteria->addCondition("descricao ILIKE '%" .$q ."%'", 'OR');
		}
    						
		$dataProvider=new CActiveDataProvider('Contato', array('criteria'=>$criteria,));
		$this->render('index',array(
			 
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Contato('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contato']))
			$model->attributes=$_GET['Contato'];

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
		$model=Contato::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='contato-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
