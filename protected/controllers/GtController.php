<?php

class GtController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/onecolumn';
	public $id_pagina="gt";

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
				'actions'=>array('index','view', 'viewProjeto', 'v'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','createProjeto', 'updateProjeto', 'updateIntro'),
				'users'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'adminProjeto', 'deleteProjeto', 'sort'),
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
		$this->redirect(array('v', 'id'=>$model->cod_gt, 'n'=>str_replace(' ', '_',$model->nome)));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionV($id, $n)
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
		$model=new GrupoTrabalho;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GrupoTrabalho']))
		{
			$model->attributes=$_POST['GrupoTrabalho'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_gt));
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
		
		if(!in_array(Yii::app()->user->name, $model->getPermited())){
			throw new CHttpException(400,'Permition Denied');
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['GrupoTrabalho']))
		{
			$model->attributes=$_POST['GrupoTrabalho'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_gt));
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
		$dataProvider=new CActiveDataProvider('GrupoTrabalho', array(
			'criteria'=>array(
				'condition'=>'t.visible=true',
				'order'=>'t.ordem, t.nome'
			),
		));
		
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages.' .Yii::app()->language);
		
		$intro_content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_intro-gts.html");
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'intro_content'=>$intro_content,
		));
	}
	
	
	/**
	 * Ordena os grupos de trabalho
	 * Acontece via requisição ajax
	 */
	public function actionSort()
	{
		if(isset($_POST['Sort']))
		{	//Aplica o sort
			$itens = $_POST["Sort"];
			foreach($itens as $order => $item){
				
				$gt = GrupoTrabalho::model()->findByPk($item);
				$gt->ordem = $order;
				$gt->save();
			}
			$this->renderPartial('_msg',array('title'=>"Alterações Salvas Com Sucesso",'msg'=>"Todas as alterações foram salvas com sucesso."));
			
		}else{
			//Renderiza a pagina
			$gts = GrupoTrabalho::model()->findAll(array('order'=>'ordem'));
			$this->render('sort',array('gts'=>$gts,));
		}
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new GrupoTrabalho('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['GrupoTrabalho']))
			$model->attributes=$_GET['GrupoTrabalho'];

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
		$model=GrupoTrabalho::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='grupo-trabalho-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	
	/**
	 * Cria um projeto novo para um GT
	 * @param integer $id - identificador do GT
	 * @throws CHttpException
	 */
	public function actionCreateProjeto($id){
		
		//Verifica se é um GT válido
		 $gt = GrupoTrabalho::model()->findByPk($id);
		 if($gt == null){
		 	//Dispara erro.
		 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		 }
		 
		if(!in_array(Yii::app()->user->name, $gt->getPermited())){
			throw new CHttpException(400,'Permition Denied');
		}
		 
		  //Cria novo projeto
		  $model=new Projeto();
		  //Seta o GT a qual ele pertnece
		  $model->cod_gt = $gt->cod_gt;

        if(isset($_POST['Projeto']))
        {
            $model->attributes=$_POST['Projeto'];
            if($model->save()) //Salva o projeto e redireciona para a pagina do projeto
                $this->redirect(array('viewProjeto','id'=>$model->cod_projeto));
        }

        $this->render('/projeto/create',array(
            'model'=>$model,
        ));
	}
	
	/**
	 * Mostra um determinado projeto
	 * @param integer $id
	 */
	public function actionViewProjeto($id){
		
		$this->render('/projeto/view',array(
            'model'=>Projeto::model()->findByPk($id),
        ));
	}
	
    
    
   /**
    * Deleta um projeto
    * @param integer $id - identidicador do projeto
    * @throws CHttpException - N�o � um POST request
    */ 
   public function actionDeleteProjeto($id)
    {
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            Projeto::model()->findByPk($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('adminProjeto'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
	/**
	 * * Gerencia todos os projetos de um dado GT
	 * @param integer $id - Identificador do GT
	 */
    public function actionAdminProjeto($id)
    {	
    	//Verifica se � um GT v�lido
		 $gt = GrupoTrabalho::model()->findByPk($id);
		 if($gt == null){
		 	//Dispara erro.
		 	throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		 }
    	
    	$model = new Projeto('search');
    	
	    
        
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Projeto']))
            $model->attributes=$_GET['Projeto'];
            
		//Seta o grupo de trabalho - que é estático
        $model->cod_gt = $gt->cod_gt; 
        $this->render('/projeto/admin',array(
            'model'=>$model,
        ));
    }
    
    /**
     * Edita um projeto
     * @param integer $id identificador do projeto
     */
    public function actionUpdateProjeto($id)
    {
        $model=Projeto::model()->findByPk($id);
		
    	if(!in_array(Yii::app()->user->name, $model->gt->getPermited())){
			throw new CHttpException(400,'Permition Denied');
		}
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Projeto']))
        {
            $model->attributes=$_POST['Projeto'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->cod_gt));
        }

        $this->render('/projeto/update',array(
            'model'=>$model,
        ));
    }
    
	/**
	 *  
	 * Edita a pagina de apresentação dos GTs
	 */
	public function actionUpdateIntro()
	{
		
		//Pasta para arquivo
		$dir = Yii::getPathOfAlias('application.data.pages.' .Yii::app()->language);
		//local do arquivo
		$file = $dir .DIRECTORY_SEPARATOR ."_intro-gts.html";

		if(isset($_POST['Pagina']))
		{	
			//Pega conteudo do arquivo
			$content = $_POST['Pagina']['conteudo'];
			//Escreve conteudo no arquivo
			$result = file_put_contents($file, $content);
			if($result)
				$this->redirect(array('/gt/index')); //Redireciona para pagina principal
			
		}
		
		//Carrega conteudo do arquivo
		$content = file_get_contents($file);
		
		$this->render('_form-intro',array(
			'content'=>$content,
			'title'=>"Apresentação dos Grupos de Trabalho",
		));
	}
	
}
