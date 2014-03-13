<?php

class PaginaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	public $id_pagina="pagina";

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
				'actions'=>array('index','view','servicos','home', 'sobre', 'pesquisa', 'advocacy','editoracao', 'eventos', 'educacao', 'consultoria', ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
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
		$model = $this->loadModel($id);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Mostra a página Sobre
	 */
	public function actionSobre(){ 
		return $this->actionView(2);
	}
	
	/**
	 * Mostra a página Home
	 */
	public function actionHome(){ 
		return $this->actionView(1);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pagina;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pagina']))
		{
			$model->attributes=$_POST['Pagina'];
			//seta o tipo da pagina para serviço
			$model->tipo = "serviço";
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_pagina));
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

		if(isset($_POST['Pagina']))
		{
			$model->attributes=$_POST['Pagina'];
			
			$purifier = new CHtmlPurifier();
			$purifier->options = array(
			'HTML.Allowed'=>'p,a[href],b,i, h1,h2,h3,h4,h5,h6, pre, span[style], table',
			);
		//	$model->conteudo = $purifier->purify($model->conteudo);
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_pagina));
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
			$model = $this->loadModel($id);
			
			//Só deixa deletar serviços, não podemos deletar páginas de sistema.
			if($model->tipo == "serviço")
				$model->delete();
			else 
			throw new CHttpException(400,'Você não pode fazer isto!.');
			

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	 public function actionIndex()
	 {
	 	return $this->actionServicos();
	 }
	/**
	 * Lists all models.
	 */
	public function actionServicos()
	{
		$dataProvider=new CActiveDataProvider('Pagina',
			array('criteria'=>array('order'=>'titulo','condition'=>"tipo = 'serviço'",),)
			);
		$this->render('servicos',array(
			'dataProvider'=>$dataProvider,
		
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->layout =	'//layouts/column2';
		$model=new Pagina('search',array('order'=>'titulo','condition'=>"tipo = 'serviço'",));
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagina']))
			$model->attributes=$_GET['Pagina'];

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
		$model=Pagina::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagina-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
