<?php

class PublicacaoController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column_pub';
	public $id_pagina="pub";

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
				'actions'=>array('index','view', 'loadDetail', ),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'addLivro'),
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Publicacao;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		 //Carrega informações dos GTs
		if(isset($_POST["Publicacao"]["pessoas"]))
		 $model->pessoas = $_POST["Publicacao"]["pessoas"];

		if(isset($_POST['Publicacao']))
		{
			$model->attributes=$_POST['Publicacao'];
			
			$model->lang = Yii::app()->language;
			
		
			if($model->validate()){
				//Salva a imagem 	
			  	$this->saveImage($model);
			}
		
			if($model->save()){
				
				//Salva as pessoas
				$this->savePeople($model);
								
				//salva se há arquivo
				$this->saveFile($model);
				
				//Redireciona para pagina da publicacao
				$this->redirect(array('view','id'=>$model->cod_publicacao));
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
		
		 //Carrega informações dos GTs
		if(isset($_POST["Publicacao"]["pessoas"]))
		 $model->pessoas = $_POST["Publicacao"]["pessoas"];
		
	
		if(isset($_POST['Publicacao']))
		{	
			$model->attributes=$_POST['Publicacao'];
			if($model->save()){
				
				//Atualiza as pessoas que fazem parte desta publicacao
				$this->savePeople($model);

				//salva se há arquivo
				$this->saveFile($model);
				
				//Salva a imagem
				$this->saveImage($model);
				
				//Redireciona para a pagina da publicação
				$this->redirect(array('view','id'=>$model->cod_publicacao));
			}
		}
		
		//Renderiza o formulario
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
	public function actionIndex($t = null)
	{
		$criteria=new CDbCriteria;
		
		//Filtra as publicações por tipo
		$criteria->compare('cod_tipo',$t);
		
		//exibe somente as publicações do CEGOV
		//$criteria->condition = 'pessoal = false';
		
		$criteria->compare('pessoal','false',false, 'AND');
		
		//Atribui a ordem para as publicações.
		$criteria->order = "ano desc, autor asc,  titulo asc";
		
		$pub_tipo = new PublicacaoTipo();
		
		if($t != NULL)
			$pub_tipo->cod_tipo = $t;
		
		$dataProvider=new CActiveDataProvider('Publicacao', array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'publicacao'=>$pub_tipo,
		));
	}
	
	/**
	 * Carrega o template de detalhamento de uma data categoria de publicacao
	 * @param integer $id - identificador da categoria.
	 */
		public function actionLoadDetail($id){
			
			echo PublicacaoTipo::model()->findByPk($id)->template;
			Yii::app()->end();
		}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		
		$model=new Publicacao('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Publicacao']))
			$model->attributes=$_GET['Publicacao'];

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
		$model=Publicacao::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='publicacao-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * 
	 * Salva o arquivo de publicacao do modelo
	 * @param Publicacao $model
	 */
	protected function saveFile(Publicacao $model){
		
					//Caminho base para os arquivos
					$dir = Yii::getPathOfAlias('webroot.files');
					
					
					//Pega arquivo de upload
					$file = CUploadedFile::getInstance($model,'file');
					
					//Verifica se tem arquivo
					if($file != NULL){
						
						//Salva a url da imagem
						$fileName = 'pub_' .$model->cod_publicacao .'.' .$file->getExtensionName();
						
						//Caminho para salvar o arquivo
						$fileDestino = $dir .DIRECTORY_SEPARATOR .$fileName;
						
						//Salva arquivo de imagem
						$file->saveAs($fileDestino);
						
						//Atualiza o link para o arquivo
						$model->href = Yii::app()->request->baseUrl .'/files/' .$fileName; 
						
						//Salva modelo novamente para gravar o link href do arquivo
						$model->save();
					}
	}

		public function actionAddLivro()
		{
		    $model=new Livro;
		
		    // uncomment the following code to enable ajax-based validation
		    /*
		    if(isset($_POST['ajax']) && $_POST['ajax']==='livro-_form_livro-form')
		    {
		        echo CActiveForm::validate($model);
		        Yii::app()->end();
		    }
		    */
		
		    if(isset($_POST['Livro']))
		    {
		        $model->attributes=$_POST['Livro'];
		        if($model->validate())
		        {
		            // form inputs are valid, do something here
		            return;
		        }
		    }
		    $this->render('_form_livro',array('model'=>$model));
		}
		
		/**
		 * 
		 * Salva a imagem da publicacação
		 * Não esquecer de setar os atributos do $_POST antes de salvar a imagem
		 * @param Publicacao $model - Instancia da publicacao com os atributos já setados
		 */		
		protected function saveImage($model){
			
			//Pasta onde as imagens serão salvas.
			$dir = Yii::getPathOfAlias('webroot.images.pubs');
			
			$file = CUploadedFile::getInstance($model,'imageFile');
			
			if($file != NULL){
						//Cria o modelo
						$model->save();
						
						//Salva a url da imagem
						$imgName = $model->cod_publicacao .'.' .$file->getExtensionName();
						$model->imagem = $imgName; 
						$imgDestino = $dir .DIRECTORY_SEPARATOR .$imgName;
						$model->save();
						
						//Salva arquivo de imagem
						$file->saveAs($imgDestino);
						
						//Redimensiona o arquivo da imagem
						Yii::import('application.extensions.image.Image');
						$image = new Image($imgDestino);
						$image->resize(100, 100, Image::AUTO);
						$image->save($imgDestino);
						
					}else{
						
						if($model->isNewRecord){
							//Só atribui imagem padrão se for uma nova publicacao
							//Cria o modelo
							$model->save();
							
							//O usuário não fez upload de imagem. Atribui imagem padrão
							$imgName = $model->cod_publicacao .".png";
							//Imagem padrão que vai ser copiada para o novo usuário sem imagem.
							$imgSource = $dir .DIRECTORY_SEPARATOR ."pub.png";
							//Destino da imagem a ser copiada
							$imgDest = $dir .DIRECTORY_SEPARATOR .$imgName;
							//Copia a imagem
							copy($imgSource, $imgDest);
							//Atribui o link para a nova imagem
							$model->imagem = $imgName;
							$model->save();
							
							
							//Redimensiona o arquivo da imagem
							Yii::import('application.extensions.image.Image');
							$image = new Image($imgDest);
							$image->resize(100, 100, Image::AUTO);
							$image->save($imgDest);
						
						}
					}
		}
		/**
		 * Salva todos as pessoas que fazem parte da publicacao
		 * @param Publicacao $model
		 */
		protected function savePeople($model){
				
				//Deleta todas as pessoas antigas
				PessoaPublicacao::model()->deleteAll('cod_publicacao = '.$model->cod_publicacao);
				
				//Adiciona as novas pessoas
				for($i=0;$i<count($model->pessoas);$i++){
							$pesPub = new PessoaPublicacao();
							$pesPub->cod_pessoa = $model->pessoas[$i];
							$pesPub->cod_publicacao = $model->cod_publicacao;
							$pesPub->save();
							unset($pesPub);
				}
			
		}
}
