<?php

class LivroController extends Controller
{
	protected $idMenu = 'menuAcervo';
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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','all','view','search','emprestimos','devolucao', 'create', 'update', 'emprestimo'),
				'users'=>array('@'),
			),
			/*
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update'),
				'expression'=>function(){
					return (Sipesq::isSupport() ||  Sipesq::getPermition('acervo.livros') >= 2);
				}
			), */

			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','create','update','historico',),
				'expression'=>function(){
					return (Sipesq::isSupport() ||  Sipesq::getPermition('acervo.livros') >= 100);
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
	 */
	public function actionCreate()
	{
		$model=new Livro;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Livro']))
		{
			$model->attributes=$_POST['Livro'];
			
			//Altera o valor para o padrão US
			$model->valor = str_replace('.', '', $model->valor);
			$model->valor = str_replace(',', '.', $model->valor);
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_livro));
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

		if(isset($_POST['Livro']))
		{
			$model->attributes=$_POST['Livro'];
			
			//Altera para o padrão US
			$model->valor = str_replace('.', '', $model->valor);
			$model->valor = str_replace(',', '.', $model->valor);
			
			if($model->save())
				$this->redirect(array('view','id'=>$model->cod_livro));
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
	 * Mostra a página inicial reduzida dos livros.
	 */
	public function actionIndex()
	{
		$this->render('index',array(
			'model'=>new Livro(),
		));
	}
	
	/**
	 * Lists all .
	 */
	public function actionAll()
	{
		$dataProvider=new CActiveDataProvider('Livro',
			array( 
				'criteria'=>array( 'order'=>'autor, titulo'),
				'pagination'=>array('pageSize'=>10))
		);
		
		$this->render('search',array(
			'dataProvider'=>$dataProvider,
			'model'=>new Livro(),
		));
	}
	
	/**
	 * Histórico de todos os empréstimos.
	 */
	public function actionHistorico()
	{
		$historico_emprestimos = EmprestimoLivro::model()->findAll(array('order'=>'data_retirada DESC'));
		$this->render('historico_emprestimos',array(
			'historico_emprestimos'=>$historico_emprestimos,
		));
	}
	
	public function actionEmprestimos()
	{
		$historico_emprestimos = EmprestimoLivro::model()->findAll(array('order'=>'data_retirada DESC','condition'=>'data_devolucao is NULL'));
		$this->render('historico_emprestimos',array(
			'historico_emprestimos'=>$historico_emprestimos,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Livro('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Livro']))
			$model->attributes=$_GET['Livro'];

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
		$model=Livro::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='livro-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
public function actionSearch($q=null)
	{	
		$model=new Livro();
		
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Livro']))
		  $model->attributes=$_GET['Livro'];
		  
		if($q != null){
				$model->titulo = $q;
		}
		
		$criteria=new CDbCriteria;
		$criteria->addSearchCondition('t.titulo', $model->titulo,true,'OR','ILIKE');
		$criteria->addSearchCondition('t.autor', $model->titulo,true,'OR','ILIKE');
		$criteria->addSearchCondition('t.isbn', $model->titulo,true,'OR','ILIKE');
		$criteria->addSearchCondition('t.nro_patrimonio', $model->titulo,true,'OR','ILIKE');
		$criteria->order = 't.titulo, t.autor ASC';

		$dataProvider=new CActiveDataProvider('Livro', array(
							'criteria'=>$criteria, 
							'pagination'=>array('pageSize'=>10,),
    						));
    						
		$this->render('search',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */	
	public function actionEmprestimo($id)
	{
    	$model=new EmprestimoLivro;
    	$model->cod_livro = $id;
    	$model->livro = $this->loadModel($id);
		$model->data_retirada = date("d/m/Y H:m:s");
        $model->data_devolucao = null;
	   	
        
        
        
	    if(isset($_POST['EmprestimoLivro']))
	    {
	    	if($model->livro->estaEmprestado())
        		throw new CHttpException(400,'Este livro já está emprestado.');	
	    	
	        $model->attributes=$_POST['EmprestimoLivro'];
	        if($model->validate())
	        {	
	        		$model->data_retirada = date("d/m/Y H:m:s");
        			$model->data_devolucao = null;
	        	
	        	if($model->save()){
	        		$this->redirect(array('view','id'=>$model->cod_livro));	
	        	}
				
	        }
	    }
	    	$this->render('emprestimo',array('model'=>$model));
	}
	/**
	 * 
	 * Devolve um livro que estava emprestado
	 * @param integer $id - Identificador do livro 
	 */
	public function actionDevolucao($id)
	{
			$results = EmprestimoLivro::model()->findAll('cod_livro = '.$id .'AND data_devolucao IS NULL');
			if(count($results) < 1){
				throw new CHttpException(400,'Este livro já foi devolvido');
			}
			$model = $results[0];
			$model->data_devolucao = date("d/m/Y H:m:s");
			if($model->save())
				$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('view', 'id'=>$model->cod_livro));
			else
				throw new CHttpException(400,'Ocorreu um erro e não foi possível devolver este livro');
	}
	
	
}
