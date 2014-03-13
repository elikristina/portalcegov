<?php

class NewController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/onecolumn';

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
				'actions'=>array('index','view', 'events', 'n'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('admin'),
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
		$this->redirect(array('n', 'id'=>$model->cod_noticia, 'n'=>str_replace(' ', '_',$model->titulo)));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionN($id, $n)
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
		$model=new Noticia;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Noticia']))
		{
			$model->attributes=$_POST['Noticia'];			
			$model->autor = Yii::app()->user->name;
			$model->data_postagem = date('d/m/Y');

			if($model->validate()){
				//Salva a imagem 	
			  	$this->saveImage($model);
			}
			
			if($model->save()) {
				$this->redirect(array('view','id'=>$model->cod_noticia));
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

		if(isset($_POST['Noticia']))
		{
			$model->attributes=$_POST['Noticia'];
			if($model->save()){
				$this->saveImage($model);
				$this->redirect(array('view','id'=>$model->cod_noticia));
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
		$dataProvider=new CActiveDataProvider('Noticia', array(
			'criteria'=>array('condition'=>'eh_evento = false', 'order'=>'cod_noticia DESC')));
		
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
/**
	 * Lists all models.
	 */
	public function actionEvents()
	{
		$dataProvider=new CActiveDataProvider('Noticia', array(
			'criteria'=>array('condition'=>'eh_evento = true', 'order'=>'cod_noticia DESC')));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Noticia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Noticia']))
			$model->attributes=$_GET['Noticia'];

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
		$model=Noticia::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='noticia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
		 * 
		 * Salva a imagem da publicacação
		 * Não esquecer de setar os atributos do $_POST antes de salvar a imagem
		 * @param Publicacao $model - Instancia da publicacao com os atributos já setados
		 */		
		protected function saveImage($model){
			
			//Pasta onde as imagens serão salvas.
			$dir = Yii::getPathOfAlias('webroot.images.carousel');
			
			$file = CUploadedFile::getInstance($model,'imageFile');
			
			if($file != NULL){
						$model->save();
							
						//Salva a url da imagem
						$imgName = $model->cod_noticia .'.' .$file->getExtensionName();
						$model->imagem = $imgName; 
						$imgDestino = $dir .DIRECTORY_SEPARATOR .$imgName;
						$model->save();
						
						//Salva arquivo de imagem
						$file->saveAs($imgDestino);
						
					}else{
						
						if($model->isNewRecord){
							//Só atribui imagem padrão se for uma nova pessoal
							
							$model->save();
							//O usuário não fez upload de imagem. Atribui imagem padrão
							$imgName = $model->cod_noticia .".png";
							//Imagem padrão que vai ser copiada para o novo usuário sem imagem.
							$imgSource = $dir .DIRECTORY_SEPARATOR ."img_cegov.png";
							//Destino da imagem a ser copiada
							$imgDest = $dir .DIRECTORY_SEPARATOR .$imgName;
							//Copia a imagem
							copy($imgSource, $imgDest);
							//Atribui o link para a nova imagem
							$model->imagem = $imgName;
							$model->save();
											
						}
					}
		}

}
