<?php

class SiteController extends Controller
{
	public $activeMenu = "SIPESQ";
		
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
	
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
				'actions'=>array('index', 'agenda', 'download', 'error', 'login'),
				'users'=>array('*'),
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('acervoDigital','filebrowser', 'logout', 'mediawiki'),
				'users'=>array('@'),
			),
			
			array('allow', 
				'actions'=>array('view', 'search'),
				'expression'=>function(){
					return !Yii::app()->user->isGuest;
				}
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
			
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
	
		
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset($_POST['LoginForm']))
		{
			$model = new LoginForm();

			$model->attributes=$_POST['LoginForm'];
			
			// Valida o usuário e se é seu primeiro login
			if($model->validate() && $model->login()){
				
			$pessoa = new Pessoa();
			$pessoa = $pessoa->findByPk(Yii::app()->user->getId());
				if($pessoa->first_login === true){
					$this->redirect(array('/pessoa/changePassword/', 'id'=>Yii::app()->user->getId()));	
				}else{
					$this->redirect(array('/'));
				}
				
			}			
		}
		$this->render('index');
	}
	
	/**
	 *Mostra a pagina inicial de uma pessoa qualquer
	 *@param integer $id - Identificador da pessoa
	 */
	public function actionView($id)
	{
		
		$model = Pessoa::model()->findByPk($id);
		
		$this->render('view', array('user'=>$model));
	}
	
	public function actionAgenda()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('agenda');
	}
	
	
	public function actionSobre()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('/site/pages/about');
	}
	
	public function actionAcervoDigital(){
		
		//Verifica se o usuários está logado
		if(Yii::app()->user->isGuest)
			$this->redirect(array('site/login'));	
		//Requere o FTP.
		$ftp = Yii::app()->ftp;
		
		//Se o usuário é um admin ele terá acesso ao FTP de admin.
		if(in_array(Yii::app()->user->name, Yii::app()->params['admins'])){
			$ftp->setActive(false);
			$ftp->username = "ADM_CEPIK";
			$ftp->password = "Adm#2011";
			$ftp->setActive(true);
		}else{
			//Usúarios para grupo que nao é admin
			$ftp->setActive(false);
			$ftp->username = "E_CEPIK";
			$ftp->password = "Equipe#2010";
			$ftp->setActive(true);
		}
				
		//Seta a pasta inicial
		$dir = '/ACERVO DIGITAL';
		
		if(isset($_GET['download'])){
			$dir = $_GET['download'];
			$link = '143.54.64.51' .$dir;
			echo '143.54.64.51' .$dir;
			header("Location: ftp://" .$link);
			//$this->redirect($link);
			Yii::app()->end();
			
		}
		
		if(isset($_GET['f']))
			$dir = $_GET['f'];
			
		
		//Define o diretório acima
		$lastDir = $ftp->currentDir();
		$lastDir = substr($lastDir, 0, strrpos($lastDir,'/') + 1);
		
		//Move para o diretório
		if($ftp->directory_exists($dir))
		 	$ftp->chdir($dir);
		 	else
		 		$ftp->chdir($lastDir);
		 			
					
		
		//Captura os arquivos
		 $files = $ftp->listFiles($ftp->currentDir());
		
		//Define o diretório acima atualizado
		$lastDir = $ftp->currentDir();
		$lastDir = substr($lastDir, 0, strrpos($lastDir,'/') + 1);
		
		$this->render('/site/acervodigital', array('ftp'=>$ftp, 'lastDir'=>$lastDir));


	}
	
public function actionDownload()
	{
		
		
 		$model = $this->loadModel($id);

 		header("Location: application/save");
		Yii::app()->end();
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
public function actionFileBrowser()
	{
		$root = '/';
		$_POST['dir'] = 'protected';
		$_POST['dir'] = urldecode($_POST['dir']);

		if( file_exists($root . $_POST['dir']) ) {
			$files = scandir($root . $_POST['dir']);
			natcasesort($files);
			if( count($files) > 2 ) { /* The 2 accounts for . and .. */
				echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
				// All dirs
				foreach( $files as $file ) {
					if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file) ) {
						echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
					}
				}
				// All files
				foreach( $files as $file ) {
					if( file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file) ) {
						$ext = preg_replace('/^.*\./', '', $file);
						echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
					}
				}
				echo "</ul>";	
			}
		}
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
				
			$pessoa = new Pessoa();
			$pessoa = $pessoa->findByPk(Yii::app()->user->getId());
			
			if($pessoa == null){
				Yii::app()->request->cookies->clear();
				$this->render('login',array('model'=>$model));
			}else{
				
					if($pessoa->first_login === true){
							$this->redirect(array('/pessoa/changePassword/', 'id'=>Yii::app()->user->getId()));	
						}else{
							$this->redirect(array('/'));
						}
				
			}
			
				
				
			}
				
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	
	
	/**
	 * 
	 * Faz uma busca geral
	 * @param string $q
	 */
	public function actionSearch($q){
		
		$criteriaPessoas = new CDbCriteria();
		$criteriaProjetos = new CDbCriteria();
		$criteriaContatos = new CDbCriteria();
		$criteriaAtividades = new CDbCriteria();

		$pessoa = CHtml::encode($q);
		
		
		//Pesquisa as pessoas
		$criteriaPessoas->with = 'projetos';
		$criteriaPessoas->together = true;
		
		$criteriaPessoas->addCondition("t.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaPessoas->addCondition("t.nome_curto ILIKE '%{$pessoa}%'", 'OR');
		$criteriaPessoas->addCondition("email ILIKE '%{$pessoa}%'", 'OR');
		$criteriaPessoas->addCondition("telefone ILIKE '%{$pessoa}%'", 'OR');
		$criteriaPessoas->addCondition("projetos.nome ILIKE '%{$pessoa}%'", 'OR');
		
		
		//Pesquisa os contatos
		
		$criteriaContatos->addCondition("nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaContatos->addCondition("email ILIKE '%{$pessoa}%'", 'OR');
		$criteriaContatos->addCondition("instituicao ILIKE '%{$pessoa}%'", 'OR');
		$criteriaContatos->addCondition("telefone ILIKE '%{$pessoa}%'", 'OR');
		$criteriaContatos->addCondition("descricao ILIKE '%{$pessoa}%'", 'OR');


		//Pesquisa as Atividades
		
		$criteriaAtividades->with = array('responsavel', 'pessoas', 'projetos');
		$criteriaAtividades->together=true;
		$criteriaAtividades->limit = 10;
		$criteriaAtividades->addCondition("nome_atividade ILIKE '%{$pessoa}%'", 'OR');
		$criteriaAtividades->addCondition("nome_atividade ILIKE '%{$pessoa}%'", 'OR');
		$criteriaAtividades->addCondition("responsavel.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaAtividades->addCondition("pessoas.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaAtividades->addCondition("projetos.nome ILIKE '%{$pessoa}%'", 'OR');

		
		//Pesquisa os projetos
		$criteriaProjetos->with = array('pessoas', 'coordenador', 'vice_coordenador', 'fiscal', 'bolsista_responsavel');
		$criteriaProjetos->together=true;
		$criteriaProjetos->addCondition("t.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("t.codigo_projeto ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("t.nome_curto ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("pessoas.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("coordenador.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("vice_coordenador.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("fiscal.nome ILIKE '%{$pessoa}%'", 'OR');
		$criteriaProjetos->addCondition("bolsista_responsavel.nome ILIKE '%{$pessoa}%'", 'OR');

		
		
		/*
		 * 'professor' => array(self::BELONGS_TO, 'Pessoa', 'cod_professor', 'select'=>'cod_pessoa, nome'),
			'pos_graduando' => array(self::BELONGS_TO, 'Pessoa', 'cod_pos_grad', 'select'=>'cod_pessoa, nome'),
			'graduando' => array(self::BELONGS_TO, 'Pessoa', 'cod_grad', 'select'=>'cod_pessoa, nome'),
			'pessoas'
		 * 
		 */
		
		

		$dataProviderPessoas=new CActiveDataProvider('Pessoa', array( 
							'pagination'=>array('pageSize'=>999,),
							'criteria'=>$criteriaPessoas
    						));
    						
    	$dataProviderProjetos=new CActiveDataProvider('Projeto', array( 
							'pagination'=>array('pageSize'=>999,),
							'criteria'=>$criteriaProjetos
    						));
    						
    	$dataProviderContatos=new CActiveDataProvider('Contato', array( 
							'pagination'=>array('pageSize'=>10,),
							'criteria'=>$criteriaContatos
    						));

    	$dataProviderAtividades=new CActiveDataProvider('Atividade', array( 
							'pagination'=>array('pageSize'=>10,),
							'criteria'=>$criteriaAtividades
    						));
		
    						
		$this->render('/site/search',array(
			'dataProviderPessoas'=>$dataProviderPessoas,
			'dataProviderProjetos'=>$dataProviderProjetos,
			'dataProviderContatos'=>$dataProviderContatos,
			'dataProviderAtividades'=>$dataProviderAtividades,
		));
		
	}
	
	
	public function actionMediaWiki(){
		$this->activeMenu = "Acervo";
		$this->render('mediawiki');
	}
	
	
}