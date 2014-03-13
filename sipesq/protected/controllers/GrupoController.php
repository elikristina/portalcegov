<?php

class GrupoController extends Controller
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
				'actions'=>array('index','pessoas', 'view'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin', 'delete', 'create', 'update', 'view', 'index'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('gerencial.relatorios') >= 100);
				}
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Renderiza as pessoas do grupo 
	 * @param unknown $id
	 */
	public function actionPessoas($id){
		$model = $this->loadModel($id);
		$this->renderPartial('_pessoas', array('pessoas'=>$model->pessoas));
		Yii::app()->end();
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Grupo;
		$model->atividade = new PermissaoAtividadeForm();
		$model->pessoa = new PermissaoPessoaForm();
		$model->projeto = new PermissaoProjetoForm();
		$model->gerencial = new PermissaoGerencialForm();
		$model->acervo = new PermissaoAcervoForm();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Grupo']))
		{
			
			$model->attributes=$_POST['Grupo'];
			
			$perm = array();
			if(isset($_POST['PermissaoAtividadeForm']))
				$perm['atividade'] = $_POST['PermissaoAtividadeForm'];
				
			if(isset($_POST['PermissaoAtividadeForm']))
				$perm['pessoa'] = $_POST['PermissaoPessoaForm'];
			
			if(isset($_POST['PermissaoProjetoForm']))
				$perm['projeto'] = $_POST['PermissaoProjetoForm'];
			
			if(isset($_POST['PermissaoAcervoForm']))
				$perm['acervo'] = $_POST['PermissaoAcervoForm'];
			
			if(isset($_POST['PermissaoGerencialForm']))
				$perm['gerencial'] = $_POST['PermissaoGerencialForm'];
				
			$model->permissao = json_encode($perm);
			
			
			if($model->save()){
				
				//Valida pessoas
				if(isset($_POST['Grupo']['pessoas'])){
					$model->pessoas = $_POST['Grupo']['pessoas'];
					$this->salvaPessoas($model->cod_grupo, $model->pessoas);
				}
				
				$this->redirect(array('index'));
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
		
		$permissoes = json_decode($model->permissao);
		$model->atividade = PermissaoAtividadeForm::load($permissoes->atividade);
		$model->pessoa = PermissaoPessoaForm::load($permissoes->pessoa);
		$model->projeto = PermissaoProjetoForm::load($permissoes->projeto);
		$model->gerencial = PermissaoGerencialForm::load($permissoes->gerencial);
		$model->acervo = PermissaoAcervoForm::load($permissoes->acervo);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Grupo']))
		{
			$model->attributes=$_POST['Grupo'];
			
			$perm = array();
			if(isset($_POST['PermissaoAtividadeForm']))
				$perm['atividade'] = $_POST['PermissaoAtividadeForm'];
			
			if(isset($_POST['PermissaoAtividadeForm']))
				$perm['pessoa'] = $_POST['PermissaoPessoaForm'];
				
			if(isset($_POST['PermissaoProjetoForm']))
				$perm['projeto'] = $_POST['PermissaoProjetoForm'];
				
			if(isset($_POST['PermissaoAcervoForm']))
				$perm['acervo'] = $_POST['PermissaoAcervoForm'];
				
			if(isset($_POST['PermissaoGerencialForm']))
				$perm['gerencial'] = $_POST['PermissaoGerencialForm'];
			
			$model->permissao = json_encode($perm);
				
			
			if($model->save()){
				
				//Valida pessoas
				if(isset($_POST['Grupo']['pessoas'])){
					$model->pessoas = $_POST['Grupo']['pessoas'];
					$this->salvaPessoas($model->cod_grupo, $model->pessoas);
				}
				
				$this->redirect(array('update','id'=>$model->cod_grupo));
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
		$dataProvider=new CActiveDataProvider('Grupo');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionView($id)
	{
		$model = $this->loadModel($id);

		$this->render('view',array(
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
		$model=Grupo::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='grupo-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 *
	 * Salvas as pessoas que fazem parte deste grupo
	 * @param integer $cod_grupo
	 * @param Array $pessoas
	 */
	private function salvaPessoas($cod_grupo,$pessoas){
		PessoaGrupo::model()->deleteAll('cod_grupo = '.$cod_grupo);
		foreach ($pessoas as $p){
			$a = new PessoaGrupo();
			$a->cod_grupo = $cod_grupo;
			$a->cod_pessoa = $p;
			$a->save();
			unset($a);
		}
	}
}
