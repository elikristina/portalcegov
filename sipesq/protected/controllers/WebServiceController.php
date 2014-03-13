<?php

class WebServiceController extends Controller
{
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
				'actions'=>array('pessoa', 'curl'),
				'users'=>array('*'),
			),
		);
	}
	
	
	public function actionIndex()
	{
		header('Access-Control-Allow-Origin: http://www.ufrgs.br');
		
		if(!isset($_POST['parms'])){
			throw new CHttpException(403);
		}
		
		$parms = $_POST['parms'];
		
		if($parms['api_key'] != "eafa54c2d4ae1d0ccbeacb763053a257")
			throw new CHttpException(403);
	
		
	   $pessoa = Pessoa::model()->find(array('condition'=>'email ILIKE :email', 'params'=>array('email'=>$parms['email'])));
	   $row =  $pessoa->getAttributes();
	   
	   header('Content-type: application/json');
	   echo CJSON::encode($row);
	   
	   foreach (Yii::app()->log->routes as $route) {
	   	if($route instanceof CWebLogRoute) {
	   		$route->enabled = false; // disable any weblogroutes
	   	}
	   }
	   
	   Yii::app()->end();
		
		
		
	}
	
	
	public function actionCurl(){
		$ch = curl_init("http://www.google.com.br/");
		$fp = fopen("pagina_exemplo.txt", "w");
		
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		
		curl_exec($ch);
		curl_close($ch);
		fclose($fp);
		
		Yii::app()->end();
		
		
	}
	
}