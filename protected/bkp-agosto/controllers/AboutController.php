<?php

class AboutController extends Controller
{
	public $layout='//layouts/column3';
	public $id_pagina = 'about';
/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'partners', 'presentation'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('updatePresentation', 'updatePartners'),
				'users'=>array('@'),
			),
		
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	
	/**
	 * Renderiza a página principal
	 */
	public function actionIndex(){
		
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages');
		
		$content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_about.html");
		
		$this->render('presentation', array(
						  'content'=>$content,
						  'title'=>'Apresentação'
						));	
	}
	
	
	/**
	 * 
	 * Renderiza pagina de apresentação
	 */
	public function actionPresentation()
	{	
		
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages');
		
		$content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_about.html");
		
		$this->render('presentation', array(
						  'content'=>$content,
						  'title'=>'Apresentação'
						));	
		
	}
	
	
	/**
	 * 
	 * Renderiza pagina de parceiros
	 */
	public function actionPartners()
	{	
		
		//Caminho para arquivos das páginas estáticas
		$dir = Yii::getPathOfAlias('application.data.pages');
		
		$content = file_get_contents($dir .DIRECTORY_SEPARATOR ."_partners.html");
		
		$this->render('partners', array(
						  'content'=>$content,
						  'title'=>'Centros e Projetos Parceiros'
						));	
		
	}
	
	/**
	 * 
	 * Edita a coluna da esquerda da página principal
	 */
	public function actionUpdatePresentation()
	{
		
		//Pasta para arquivo
		$dir = Yii::getPathOfAlias('application.data.pages');
		//local do arquivo
		$file = $dir .DIRECTORY_SEPARATOR ."_about.html";

		if(isset($_POST['Pagina']))
		{	
			//Pega conteudo do arquivo
			$content = $_POST['Pagina']['conteudo'];
			//Escreve conteudo no arquivo
			$result = file_put_contents($file, $content);
			if($result)
				$this->redirect(array('/about/presentation')); //Redireciona para pagina principal
			
		}
		
		//Carrega conteudo do arquivo
		$content = file_get_contents($file);
		
		$this->render('_form',array(
			'content'=>$content,
			'title'=>"Apresentação",
		));
	}
	
	/**
	 *  
	 * Edita a pagina de apresentação
	 */
	public function actionUpdatePartners()
	{
		
		//Pasta para arquivo
		$dir = Yii::getPathOfAlias('application.data.pages');
		//local do arquivo
		$file = $dir .DIRECTORY_SEPARATOR ."_partners.html";

		if(isset($_POST['Pagina']))
		{	
			//Pega conteudo do arquivo
			$content = $_POST['Pagina']['conteudo'];
			//Escreve conteudo no arquivo
			$result = file_put_contents($file, $content);
			if($result)
				$this->redirect(array('/about/partners')); //Redireciona para pagina principal
			
		}
		
		//Carrega conteudo do arquivo
		$content = file_get_contents($file);
		
		$this->render('_form',array(
			'content'=>$content,
			'title'=>"Centros e Projetos Parceiros",
		));
	}
}