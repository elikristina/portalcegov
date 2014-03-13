<?php

class ProjetoDespesaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column_new';
	public $activeMenu = "Projetos";

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
				'actions'=>array('json', 'downloadFile', 'index','view', 'viewAjax', 'geraXml'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 1);					
				}
			),
			
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create','add', 'update','formAdicional', 'infoRubrica'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 2);
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin', 'delete'),				
				'expression'=>function(){												
					return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.financeiro') >= 100);
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewAjax($id)
	{
		$this->layout = '//layouts/ajax';
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	
	/**
	 * Cria uma nova despesa 
	 * Oferece escolha de receita antes
	 * @param integer $id Projeto.cod_projeto
	 */
	public function actionCreate($id)
	{
		$model = Projeto::model()->findByPk($id);
		
		if($model == null) throw new CHttpException(404);
	
		$this->render('choose_receita',array(
				'model'=>$model,
		));
	}
	
	

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionAdd($id)
	{
		$verba = new ProjetoVerba();
		$verba = $verba->findByPk($id);
		
		if($verba == null){
			throw new CHttpException(404,'Página não encontrada!');
		}
		
		$model=new ProjetoDespesa;
		
		//Atribui o projeto a despesa TODO - REMOVER PROJETO!!!
		$model->cod_projeto = $verba->projeto->cod_projeto;
		
		//Atribui a verba vinculada
		$model->cod_verba = $verba->cod_verba;
		$model->verba = $verba;
		
		//Carrega a rubrica vinculada
		if(isset($_GET['ru'])){
			$model->cod_rubrica = $_GET['ru'];
			if(Rubrica::model()->count('cod_rubrica =' .$model->cod_rubrica) < 1)
				throw new CHttpException(404, "Rubrica Inexistente");
		}
		
		//Campos ocultos
		$model->data_edicao = date('Y-m-d');
		$model->data_inclusao = date('Y-m-d');
		$model->cod_criador = Yii::app()->user->getId();
		
		if(isset($_POST['ProjetoDespesa']))
		{
			$model->attributes=$_POST['ProjetoDespesa'];
			if($model->save()){
				
				//Salva os novos tokens
				$this->saveTokens();
				
				//Salva o arquivo da despesa
				$this->saveFile($model);
				
				//Salva campos adicionais
				$this->saveInfo($model);
				
				$this->redirect(array('/projeto/financeiro','id'=>$verba->projeto->cod_projeto));
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
			'verba'=>$verba,
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
		
		$doc_dir = Yii::getPathOfAlias('application.data.despesas');
		
		$view = 'update';
		
		if(isset($_GET['ajax']) && $_GET['ajax'] == true){
			$this->layout = '//layouts/ajax';
			$view = '_form';
		}
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProjetoDespesa']))
		{
			$model->attributes=$_POST['ProjetoDespesa'];
			if($model->save()){
				
				if(isset($_POST['ProjetoDespesa']['new_tokens'])){
					$new_tokens = explode(',', $_POST['ProjetoDespesa']['new_tokens']);
					foreach( $new_tokens as $nt){
						$token = new PessoaToken();
						$token->nome = $nt;
						$token->save();
					}
				}
				
				//Salva o arquivo da despesa
				$file = CUploadedFile::getInstance($model,'documento');
				
				if($file != null){
					/*
					if($this->documento != null){
						file_exists($filename)
					}*/
					$doc_dir = Yii::getPathOfAlias('application.data.despesas');
					
					//Faz um nome único para o arquivo
					$docname = $model->cod_despesa . '_' .$file->name;

					//Salva o nome do arquivo
					$model->documento = $docname;
					$model->save();
					
					//Salva o arquivo
					if(!$file->saveAs($doc_dir .DIRECTORY_SEPARATOR .$docname)){
						throw new CHttpException(500, "Não foi possível salvar o arquivo");	
					}
				}
				
				//Salva todos os campos adicionais
				if(isset($_POST['ProjetoDespesaInfo'])){
					foreach($_POST['ProjetoDespesaInfo'] as $key=>$dps){
						
						$despesa = ProjetoDespesaInfo::model()->findByPk($dps['cod_info']);
						
						if($despesa == null){
							//$despesa = new ProjetoDespesaInfo();
						}
						
						echo $dps['cod_info'];
							
							
						$despesa->cod_despesa = $model->cod_despesa;
						$despesa->attributes = $dps;
						
						//Salva a despesa antes para usar seu código único no nome do arquivo
						$despesa->save(true);
						
						//Verifica se o tipo de campo é um Arquivo
						if($dps['tipo'] == RubricaCampo::CAMPO_ANEXO){
							
							//Salva o arquivo do campo adicional
							$info_file = CUploadedFile::getInstanceByName('ProjetoDespesaInfo[' .$key .'][valor]');
							if($info_file != null){
								$docname = $model->cod_despesa . $despesa->cod_info .'_' .$info_file->name;
								
								$info_file->saveAs($doc_dir .DIRECTORY_SEPARATOR .$docname);
								
								//Salva o nome do arquivo
								$despesa->valor = $docname;
								$despesa->save();
							}
						}//fim anexo
						
					}
				}//PostDespesaInfo
				
				//$this->redirect(array('view','id'=>$model->cod_despesa));
				$this->redirect(array('/projeto/financeiro/','id'=>$model->verba->projeto->cod_projeto));
			}
				
		}
	
		if($model->cod_verba == null){
			$this->render('_form2',array(
					'model'=>$model,
			));
		}else{
			$this->render('update',array(
					'model'=>$model,
			));
		}
		
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		
		$model = $this->loadModel($id);
		$projeto = $model->cod_projeto;
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/projeto/financeiro', 'id'=>$projeto, 'p'=>'financeiro'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($id)
	{
		$criteria = new CDbCriteria();
		$criteria->compare('cod_projeto', (int)$id);
		$dataProvider=new CActiveDataProvider('ProjetoDespesa', array('criteria'=>$criteria));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new ProjetoDespesa('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProjetoDespesa']))
			$model->attributes=$_GET['ProjetoDespesa'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Renderiza um formulario sem layout
	 * @param integer $id - identifica a rubrica
	 */
	public function actionFormAdicional($id){
		$this->layout = false;
		$rubrica = new Rubrica();
		$rubrica = Rubrica::model()->findByPk($id);
		$this->render('_form_adicional',array(
			'model'=>$rubrica,
		));
		
	}
	
	
	/**
	 * Renderiza um formulario sem layout
	 * @param integer $id - identifica a rubrica
	 */
	public function actionInfoRubrica($id){
		$this->layout = false;
		$rubrica = new Rubrica();
		$rubrica = Rubrica::model()->findByPk($id);
		echo json_encode(array_merge(
				$rubrica->getAttributes(array('cod_rubrica','nome','descricao'))
				, array('saldo'=>Yii::app()->format->number($rubrica->getSaldo($_GET['cod_verba'])	))));
		Yii::app()->end();
		
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ProjetoDespesa::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='projeto-despesa-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
/**
	 * 
	 * @param integer $id
	 */
	public function actionGeraXml($id){
		//header('Content-Type: text/xml');
		$model = ProjetoDespesa::model()->findByPk($id);
		$this->layout = false;
		if($model ==null){
			throw new CHttpException(404, 'Página não encontrada');
		}
		//$this->render('geraXML', array('model'=>$model));
		
		Yii::app()->request->sendFile(
				'Relatorio_' .$model->rubrica->nome .'_' .$model->comprador .'_' .$model->data_inclusao	.'.doc'
				, $this->renderPartial('geraXML', array('model'=>$model)
				, 'application/xml'));
				
		
		//procura modelo
		
		//renderiza xml
	}
	
	
	/**
	 * 
	 * @param string $file
	 */
	public function actionDownloadFile($file){
		
		$this->layout = false;
		$url = Yii::app()->baseUrl ."/protected/data/despesas/";
		$content = file_get_contents(Yii::getPathOfAlias('application.data.despesas') .DIRECTORY_SEPARATOR .$file);
		$filename = $filename = substr($file, stripos($file, '_') + 1);
		Yii::app()->request->sendFile($filename, $content);
		
	}
	
	
	/**
	 * JSON Test
	 */
	public function actionJson()
	{  
		$this->layout=false;
		header('Content-type: application/json');

		$criteria = new CDbCriteria();
		//$criteria->select = array('nome');
		$criteria->order = 'nome';
		$criteria->limit = 20;
		
		if(isset($_GET['q'])){
			$term = CHtml::encode($_GET['q']);
			$criteria->addCondition("nome ILIKE '%{$term}%'", 'AND');	
		}
 		
		$pessoas = Pessoa::model()->findAll($criteria);
		$tokens = PessoaToken::model()->findAll($criteria);
		$contatos = Contato::model()->findAll($criteria);

		$results = array();

		foreach ($pessoas as $p) {
			$results[$p->nome] = array('name'=>$p->nome, 'id'=>$p->cod_pessoa);
		}
		
		foreach ($tokens as $p) {
			$results[$p->nome] = array('name'=>$p->nome, 'id'=>$p->cod_token);
		}

		foreach ($contatos as $p) {
			$results[$p->nome] = array('name'=>$p->nome, 'id'=>$p->cod_contato);
		}

		//echo json_encode($results);
		$arr = array();
		foreach ($results as $r) {
			$arr[] = $r;
		}

		echo json_encode($arr);
		
		Yii::app()->end();
	}


	/**
	 * Salva os tokens novos
	 */
	
	private function saveTokens(){
		
		if(isset($_POST['ProjetoDespesa']['new_tokens'])){
			$new_tokens = explode(',', $_POST['ProjetoDespesa']['new_tokens']);
			foreach( $new_tokens as $nt){
				$token = new PessoaToken();
				$token->nome = $nt;
				$token->save();
			}
		}
	}
	
	/**
	 * salva os arquivos da despesa
	 * @param ProjetoDespesa $model
	 */
	private function saveFile($model){
	
		$file = CUploadedFile::getInstance($model,'documento');
		$doc_dir = Yii::getPathOfAlias('application.data.despesas');
		
		if($file != null){
				
			//Faz um nome único para o arquivo
			$docname = $model->cod_despesa . '_' .$file->name;
				
			//Salva o arquivo
			$file->saveAs($doc_dir .DIRECTORY_SEPARATOR .$docname);
				
			//Salva o nome do arquivo
			$model->documento = $docname;
			$model->save();
		}
	}
	
	
	/**
	 * Salva todos os campos adicionais
	 * @param ProjetoDespesa $model
	 */
	private function saveInfo($model){

		$doc_dir = Yii::getPathOfAlias('application.data.despesas');
		
		//Salva todos os campos adicionais
		if(isset($_POST['ProjetoDespesaInfo'])){
			foreach($_POST['ProjetoDespesaInfo'] as $key=>$dps){
		
				$despesa = new ProjetoDespesaInfo();
				$despesa->cod_despesa = $model->cod_despesa;
				$despesa->attributes = $dps;
		
				//Salva a despesa antes para usar seu código único no nome do arquivo
				$despesa->save();
		
				//Verifica se o tipo de campo é um Arquivo
				if($dps['tipo'] == RubricaCampo::CAMPO_ANEXO){
						
					//Salva o arquivo do campo adicional
					$info_file = CUploadedFile::getInstanceByName('ProjetoDespesaInfo[' .$key .'][valor]');
					if($info_file != null){
						$docname = $model->cod_despesa . $despesa->cod_info .'_' .$info_file->name;
		
						$info_file->saveAs($doc_dir .DIRECTORY_SEPARATOR .$docname);
		
						//Salva o nome do arquivo
						$despesa->valor = $docname;
						$despesa->save();
					}
				}//fim anexo
		
			}
		}//PostDespesaInfo
	}
	
	/**
	 * Descobre a partir da rubrica escolhida qual o pote relacionado a despesa
	 * @param Projeto $model
	 * @param ProjetoDespesa $projeto
	 */
	private function findVerba($model, $projeto){
		
		foreach($projeto->receitas as $rec){
			foreach($rec->rubricas as $rub){
				
				if($model->cod_rubrica == $rub->cod_rubrica){
					$model->cod_verba = $rec->cod_verba;
					$model->verba = $rec;
					return $model;						
				}
			}
		}
		
		throw new CHttpException(404, "Não foi possível determinar o recebimento através da rubrica");
		
	}
	
	
}
