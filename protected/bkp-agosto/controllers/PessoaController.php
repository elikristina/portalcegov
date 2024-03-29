<?php

class PessoaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column3';
	public $id_pagina="equipe";

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
				'actions'=>array('index','view' ,'function', 'create'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'updateIntro', 'updatePesquisa', 'updateApp'),
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
		//Seta o layout
		$this->layout='//layouts/column1';
		
		//Pasta onde as imagens serão salvas.
		$dir = Yii::getPathOfAlias('webroot.images.profiles');
		
		$model=new Pessoa;
		//Configura uma senha padrão
		$model->senha = "Cegov#2012";
		$model->senha_confirm = $model->senha;
		
		//Carrega informações de funções
		if(isset($_POST["Pessoa"]["categorias"]))
		 $model->categorias = $_POST["Pessoa"]["categorias"];
		 
		 //Carrega informações dos GTs
		if(isset($_POST["Pessoa"]["grupos"]))
		 $model->grupos = $_POST["Pessoa"]["grupos"];
		 
		if(isset($_POST['Pessoa']))
		{
			//Carrega os atributos
			$model->attributes=$_POST['Pessoa'];

			//Carrega o arquivo da imagem
			$file = CUploadedFile::getInstance($model,'imageFile');
			
			if($model->validate()){
				//Salva a imagem do usuário	
			  	$this->saveImage($model);
			}
						
			if($model->save()){
				
			  	//Salva as categorias que esta pessoa pertence
				$this->saveCategory($model);
				
				//Atualiza os Grupos de trabalho do qual esta pessoa participa
				$this->saveGts($model);
				
				$this->redirect(array('view','id'=>$model->cod_pessoa));						
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
		//Seta o layout
		$this->layout='//layouts/column1';
		
		//Pasta onde as imagens serão salvas.
		$dir = Yii::getPathOfAlias('webroot.images.profiles');
		
		$model=$this->loadModel($id);

		//Carrega informações de funções
		if(isset($_POST["Pessoa"]["categorias"]))
		 $model->categorias = $_POST["Pessoa"]["categorias"];
		 
		 //Carreta informações dos GTs
		if(isset($_POST["Pessoa"]["grupos"]))
		 $model->grupos = $_POST["Pessoa"]["grupos"];

		if(isset($_POST['Pessoa']))
		{
			$model->attributes=$_POST['Pessoa'];
				
			if($model->save()){

				
			  	//Salva a imagem do usuário	
			  	$this->saveImage($model);

			  	//Salva as categorias que esta pessoa pertence
				$this->saveCategory($model);
				
				//Atualiza os Grupos de trabalho do qual esta pessoa participa
				$this->saveGts($model);
				
				
				$this->redirect(array('view','id'=>$model->cod_pessoa));
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
		
		// we only allow deletion via POST request
		if(Yii::app()->request->isPostRequest)
		{
			//Carrega a pessoa
			$model = $this->loadModel($id);
			//Monta um array com os GTs que ela atua 
			$gts = array();
			foreach($model->gts_coordenador as $gt){
				$gts[] = $gt->nome;
			}
			
			//Só deleta se não for coordenador de nenhum GT
			if(count($model->gts_coordenador)){
				//throw new CHttpException(400, $model->nome . ' não pode ser deletado, pois é coordenador do(s) GT(s): ' .implode(', ', $gts));
				//echo $model->nome . ' não pode ser deletado, pois é coordenador do(s) GT(s): ' .implode(', ', $gts);
				$this->render('error',array('model'=>$model));
			}else{
				
				//Deleta a pessoa
				$model->delete();
			
				// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
				if(!isset($_GET['ajax']))
					$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
				
			}
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$data = Categoria::model()->findAll(array('condition'=>"cod_categoria_pai is NULL" , 'order'=>'t.ordem, pessoas.nome', 'with'=>array('pessoas')));
		
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages');
		
		$intro_content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_intro-equipe.html");
		
		$this->render('home',array(
			'data'=>$data,
			'intro_content'=>$intro_content,
		));
	}
	
	/**
	 * 
	 * Mostra as pessoas de uma determinada categoria
	 * @param integer $id - identificador da categoria
	 */
	
	public function actionFunction($id)
	{
		$dataProvider=new CActiveDataProvider('Pessoa',  array(
			                'criteria' => array(
			                 'with' => array('categorias'),
							'condition'=> 'categorias.cod_categoria = '.$id,
			                'together'=>true)));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'titulo'=>Categoria::model()->findByPk($id)->nome,
		));
	}
	
	
	
/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Pessoa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='pessoa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionAdmin()
		{
			$model=new Pessoa('search');
			$model->unsetAttributes();  // clear any default values
			if(isset($_GET['Pessoa']))
				$model->attributes=$_GET['Pessoa'];
	
			$this->render('admin',array(
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
		$dir = Yii::getPathOfAlias('application.data.pages');
		//local do arquivo
		$file = $dir .DIRECTORY_SEPARATOR ."_intro-equipe.html";

		if(isset($_POST['Pagina']))
		{	
			//Pega conteudo do arquivo
			$content = $_POST['Pagina']['conteudo'];
			//Escreve conteudo no arquivo
			$result = file_put_contents($file, $content);
			if($result)
				$this->redirect(array('/pessoa/index')); //Redireciona para pagina principal
			
		}
		
		//Carrega conteudo do arquivo
		$content = file_get_contents($file);
		
		$this->render('_form-intro',array(
			'content'=>$content,
			'title'=>"Apresentação da Equipe",
		));
	}
	
	
 
	/**
	 *  
	 * Edita a pagina de pesquisa de um determinado pesquisador
	 */
	public function actionUpdatePesquisa($id)
	{	
		$pessoa = Pessoa::model()->findByPk($id);
		if(isset($_POST['Pessoa']))
		{	
			//Pega conteudo do arquivo
			$pessoa->pesquisa = $_POST['Pessoa']['pesquisa'];
			if($pessoa->save(false)) //salva sem validação
				$this->redirect(array('/pessoa/view', 'id'=>$pessoa->cod_pessoa)); //Redireciona para pagina principal
				
		}else
		{
			$this->render('_form-pesquisa',array(
			'content'=>$pessoa->pesquisa,
			'title'=>"Pesuisas de " .$pessoa->nome,
			));
		}
	}
	
/**
	 *  
	 * Edita a pagina de pesquisa de um determinado pesquisador
	 */
	public function actionUpdateApp($id)
	{	
		$pessoa = Pessoa::model()->findByPk($id);
		if(isset($_POST['Pessoa']))
		{	
			//Pega conteudo do arquivo
			$pessoa->descricao = $_POST['Pessoa']['pesquisa'];
			if($pessoa->save(false)) //salva sem validação
				$this->redirect(array('/pessoa/view', 'id'=>$pessoa->cod_pessoa)); //Redireciona para pagina principal
				
		}else
		{
			$this->render('_form-pesquisa',array(
			'content'=>$pessoa->descricao,
			'title'=>"Apresentação de " .$pessoa->nome,
			));
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
			$dir = Yii::getPathOfAlias('webroot.images.profiles');
			
			$file = CUploadedFile::getInstance($model,'imageFile');
			
			if($file != NULL){
						$model->save();
							
						//Salva a url da imagem
						$imgName = $model->cod_pessoa .'.' .$file->getExtensionName();
						$model->imagem = $imgName; 
						$imgDestino = $dir .DIRECTORY_SEPARATOR .$imgName;
						$model->save();
						
						//Salva arquivo de imagem
						$file->saveAs($imgDestino);
						
						//Redimensiona o arquivo da imagem
						Yii::import('application.extensions.image.Image');
						$image = new Image($imgDestino);
						$image->resize(300, 300, Image::AUTO);
						$image->save($imgDestino);
						
					}else{
						
						if($model->isNewRecord){
							//Só atribui imagem padrão se for uma nova publicacao
							
							$model->save();
							//O usuário não fez upload de imagem. Atribui imagem padrão
							$imgName = $model->cod_pessoa .".jpg";
							//Imagem padrão que vai ser copiada para o novo usuário sem imagem.
							$imgSource = $dir .DIRECTORY_SEPARATOR ."membro.jpg";
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
		 * 
		 * Coloca as categorias do modelo
		 * @param Pessoa $model
		 */
		protected function saveCategory($model){
			
		//Salva as categorias que esta pessoa possui.				
				PessoaCategoria::model()->deleteAll('cod_pessoa = '.$model->cod_pessoa);
				for($i=0;$i<count($model->categorias);$i++){
							$categoria = new PessoaCategoria();
							$categoria->cod_categoria = $model->categorias[$i];
							$categoria->cod_pessoa = $model->cod_pessoa;
							$categoria->save();
							unset($categoria);
				}
			
		}
		

		/**
		 * 
		 * Salva os GTS que esta pessoa trabalha
		 * @param $model
		 * @throws CHttpException
		 */
		protected function saveGts($model){
				
				PessoaGT::model()->deleteAll('cod_pessoa = '.$model->cod_pessoa);
				for($i=0;$i<count($model->grupos);$i++){
							$gt = new PessoaGT();
							$gt->cod_gt = $model->grupos[$i];
							$gt->cod_pessoa = $model->cod_pessoa;
							$gt->save();
							unset($gt);
				}
		}
	
}
					