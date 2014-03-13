<?php

class SiteController extends Controller
{
	
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/column3';
	public $id_pagina="home";
	
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages');
		
		$content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_home.html");
		
		$this->render('index', array(
						  'content'=>$content,
						  'title'=>'Home'
						));	
		
		
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
				mail("contato@isape.com.br",$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Obrigado por entrar em contato.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
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
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}
	
public function actionAcervoDigital(){
		//Requere o FTP.
		$ftp = Yii::app()->ftp;
		
		//Seta a pasta inicial
		$dir = '/ACERVO DIGITAL';
		
		if(isset($_GET['download'])){
			$dir = $_GET['download'];
			$link = '143.54.64.51' .$dir;
			header("Location: ftp://" .$link);
			echo '143.54.64.51' .$dir;
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
	 * Edita a coluna da esquerda da página principal
	 */
	public function actionUpdate()
	{
		
		//Pasta para arquivo
		$dir = Yii::getPathOfAlias('application.data.pages');
		//local do arquivo
		$file = $dir .DIRECTORY_SEPARATOR ."_home.html";

		if(isset($_POST['Pagina']))
		{	
			//Pega conteudo do arquivo
			$content = $_POST['Pagina']['conteudo'];
			//Escreve conteudo no arquivo
			$result = file_put_contents($file, $content);
			if($result)
				$this->redirect(array('/site/index')); //Redireciona para pagina principal
			
		}
		
		//Carrega conteudo do arquivo
		$content = file_get_contents($file);
		
		$this->render('_form',array(
			'content'=>$content,
			'title'=>"Home",
		));
	}
	
}
