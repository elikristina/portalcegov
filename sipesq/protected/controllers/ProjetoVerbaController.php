<?php

class ProjetoVerbaController extends Controller
{

	public $layout='//layouts/column_new';
	public $activeMenu = "Projetos";
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete, deleteDesembolso', // we only allow deletion via POST request
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
				'actions'=>array('viewAjax', 'view'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 1);					
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('update', 'create', 'createDesembolso', 'updateDesembolso'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 2);					
				}
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('delete', 'deleteDesembolso'),				
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
	 * 
	 * Edita uma verba
	 * @param integer $id - Identificador da verba
	 */
	public function actionDelete($id)
	{
		
		$model=new ProjetoVerba();
		$model = ProjetoVerba::model()->findByPk($id);
		
		if($model == null){
			throw new CHttpException(404);
		}
		
		$cod_projeto = $model->cod_projeto;

		if($model->delete())
			$this->redirect(array('/projeto/view','id'=>$cod_projeto));

	}
	
	/**
	 * 
	 * Edita uma verba
	 * @param integer $id - Identificador da verba
	 */
	public function actionUpdate($id, $ajax=false)
	{
		$view = 'update';
		
		if(isset($_GET['ajax']) && $_GET['ajax'] == true){
			$this->layout = '//layouts/ajax';
			$view = '_form';
		}
		
		$model=new ProjetoVerba();
		$model = ProjetoVerba::model()->findByPk($id);

		if(isset($_POST['ProjetoVerba']))
		{
			$model->attributes=$_POST['ProjetoVerba'];
			
			if(isset($_POST['ProjetoVerba']['rubricas']))
				$model->rubricas = $_POST['ProjetoVerba']['rubricas'];
			
			if($model->save()){
				//Redireciona para o projeto
				$this->saveRubricas($model->cod_verba, $model->rubricas);
				
				$this->redirect(array('view','id'=>$model->cod_verba));
			}
				
		}
		

		$this->render($view,array(
			'model'=>$model,
			'rubricas'=>$this->getRubricas($model)
		));
		
	}
	
	
	/**
	 * 
	 * Cria uma verba para um projeto de uma determinada rubrica
	 * @param integer $id - projeto vinculado
	 */
	public function actionCreate($id)
	{
		
		$model=new ProjetoVerba();
		
		//@var Projeto projeto
		$projeto = Projeto::model()->findByPk($id);
		
		if($projeto == null){
			//Projeto inexistente
			throw new CHttpException('404');
		}
		
		
		$model->cod_projeto = $id;
		$model->projeto = $projeto;
		

		if(isset($_POST['ProjetoVerba']))
		{
			$model->attributes=$_POST['ProjetoVerba'];
			
			if(isset($_POST['ProjetoVerba']['rubricas']))
				$model->rubricas = $_POST['ProjetoVerba']['rubricas'];
			
			if($model->save()){
				
				//Salva as rubricas da receita
				$this->saveRubricas($model->cod_verba, $model->rubricas);
				
				//Adiciona desembolso inicial
				$this->desembolsoInicial($model);
				
				//Redireciona para o projeto
				$this->redirect(array('view','id'=>$model->cod_verba));
			}
				
		}
		
		
		if(count($model->projeto->orcamentos) > 0){
			$this->render('create',array(
					'model'=>$model,
					'rubricas'=>$this->getRubricas($model)
			));
		}else{
			$this->render('_alert_orcamentos',array(
					'projeto'=>$projeto,
			));
		}

			
		
	}

	/**
	 * 
	 * Carrega a pagina de uma verba
	 * @param integer $id
	 * @var ProjetoVerba $model
	 */
	public function actionView($id){
		//@var ProjetoVerba $model
		$model = ProjetoVerba::model()->findByPk($id);
		
		if(isset($_GET['ajax']) && $_GET['ajax'] == true){
			//$this->layout = '//layouts/ajax';
			$this->layout = false;
		}
		
		if($model == null){
			//throw new CHttpException('404');
		}
		
		$this->render('view', array('model'=>$model));
		
	}
	
/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ProjetoVerba::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
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
		Yii::app()->end();
		
	}
	
	
	/**
	 * 
	 * @param integer $cod_verba
	 * @param Array $rubricas[]
	 * @return boolean - se todas as alterações foram efetivas
	 */
	private function saveRubricas($cod_verba, $rubricas){
		
		ProjetoVerbaRubrica::model()->deleteAll('cod_verba = '.$cod_verba);
		foreach($rubricas as $rub){
			$pvr = new ProjetoVerbaRubrica();
			$pvr->cod_rubrica = $rub;
			$pvr->cod_verba = $cod_verba;
			if(!$pvr->save())
				return false;
			unset($pvr);
		}
		return true;
		
	}
	
	/**
	 * Adiciona um desembolso inicial
	 * @param ProjetoVerba $model
	 * @return boolean - Se o desembolso foi adicionado corretamente
	 */
	private function desembolsoInicial($model){
		
		//Adiciona desembolso inicial
		$desembolso = new ProjetoDesembolso();
		$desembolso->cod_verba = $model->cod_verba;
		$desembolso->valor = $model->valor;
		$desembolso->data = date('Y-m-d');
		
		if($desembolso->save()){
			return true;
		}else{
			return false;
		}
		
	}
	
	
	/**
	 * Cria um desembolso para esta verba
	 * @param integer $id - Identificador da verba (cod_verba)
	 */
	public function actionCreateDesembolso($id){
		//@var $verba ProjetoVerba
		//@var $model ProjetoDesembolso
		
		$model = new ProjetoDesembolso();
		$verba = ProjetoVerba::model()->findByPk($id);
		if($verba == null){
			throw new CHttpException('404', "Receita inexistente");
		}
		
		$model->cod_verba = $verba->cod_verba;
		$model->verba = $verba;
		
		
		if(isset($_POST['ProjetoDesembolso']))
		{
			$model->attributes=$_POST['ProjetoDesembolso'];
				
				
			if($model->save()){
				//Redireciona para o projeto
				$this->redirect(array('projetoVerba/view','id'=>$model->verba->cod_verba));
			}
		}
		
		$this->render('desembolso/create',array(
				'model'=>$model,
		));
		
		
	}
	
	/**
	 * 
	 * @param ProjetoVerba $model
	 * @return array Rubrica[]
	 */
	private function getRubricas($model){

		$criteria = new CDbCriteria();
		$criteria->with = array('pai', 'orcamentos');
		$criteria->order = 't.nome';
		$criteria->condition = 'orcamentos.cod_projeto = :p';
		$criteria->params = array('p'=>$model->cod_projeto);
		$criteria->addNotInCondition('t.cod_rubrica', $model->projeto->getRubricasComReceita());
		$rubricas = Rubrica::model()->findAll($criteria);
		return array_merge($rubricas, $model->rubricas);
	}
	
	
	/**
	 * Edita um desembolso
	 * @param integer $id
	 */
	public function actionUpdateDesembolso($id){
		
		//@var $verba ProjetoVerba
		//@var $model ProjetoDesembolso
		
		$model = new ProjetoDesembolso();
		$model = $model->findByPk($id);
		
		if($model == null){
			throw new CHttpException('404', "Receita inexistente");
		}
		
		
		
		if(isset($_POST['ProjetoDesembolso']))
		{
			$model->attributes=$_POST['ProjetoDesembolso'];
		
		
			if($model->save()){
				//Redireciona para o projeto
				$this->redirect(array('projetoVerba/view','id'=>$model->verba->cod_verba));
			}
		}
		
		$this->render('desembolso/create',array(
				'model'=>$model,
		));
		
	}

	
	/**
	 * Deleta um desembolso
	 * @param integer $id - identificador do desembolso
	 */
	public function actionDeleteDesembolso($id){
		
		$model=new ProjetoDesembolso();
		$model = ProjetoDesembolso::model()->findByPk($id);
		
		if($model == null){
			throw new CHttpException(404);
		}
		
		$cod_verba = $model->cod_verba;
		
		if($model->delete())
			$this->redirect(array('projetoVerba/view','id'=>$cod_verba));
	}
	
	

	/**
	 * Deleta um desembolso
	 * @param integer $id - identificador do desembolso
	 */
	public function actionSetup(){
		
		$this->layout = false;
		
		$verbas = ProjetoVerba::model()->findAll();
		echo count($verbas) ." verbas encontradas<br>";
			
		foreach($verbas as $k=>$v){
			
			echo "<br>" .($k+1) ." Setup verba " .$v->cod_verba;
			
			$pj = ProjetoVerbaRubrica::model()->find('cod_rubrica = :r AND cod_verba = :v', 
					array('v'=>$v->cod_verba, 'r'=>$v->cod_rubrica));
			
			
			//vincula esta verba a uma rubrica caso nao tenha 
			if($pj === null){
				$pj = new ProjetoVerbaRubrica();
				$pj->cod_rubrica = $v->cod_rubrica;
				$pj->cod_verba = $v->cod_verba;
				$pj->save();
				
				echo "<br> Vinculando verba " .$v->cod_verba ." a rubrica " .$v->cod_rubrica;
				
			}else{
				echo "<br> Verba ja contem rubrica vinculada";
			}

			//Adiciona um desembolso inicial caso nao tenha
			if(count($v->desembolsos) < 1){
				$desembolso = new ProjetoDesembolso();
				$desembolso->cod_verba = $v->cod_verba;
				$desembolso->data = date('Y-m-d');
				$desembolso->valor = $v->valor;
				$desembolso->save();
				echo "<br>Desembolso Salvo " .$desembolso->valor;
			}else{
				echo "<br> Verba ja contem desembolso";
			}
			
			echo '<hr>';
			
		}//endforeach		
	}
	
	
}