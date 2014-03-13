<?php

class PessoaController extends Controller
{
	public $activeMenu = "Pessoas";
	protected $idMenu = 'menuGerencial';
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

			array('allow','actions'=>array('create', 'view'), 'expression'=>function($user, $rules){
				if (Sipesq::getPermition('pessoa.informacoes') >= 1) return true;

				if(isset($_GET['id']) && $_GET['id'] == $user->getId()) return true;

				return false;
			
			}),	
			
			array('allow','actions'=>array('update'), 'expression'=>function(){
				$user = Yii::app()->user->getId();
				
				if (Sipesq::getPermition('pessoa.informacoes_avancadas', $user) >= 2) return true;
				
				if($_GET['id'] == $user) return true;
				
				
				return false;
			}),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('changePassword'),
				'expression'=>function(){
					if (Sipesq::getPermition('pessoa.informacoes_avancadas') >= 100) return true;
					
					if ($_GET['id'] == Yii::app()->user->getId()) return true;
					
					return false;
				}
			),
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('admin','delete'),
					'expression'=>function(){
						if (Sipesq::getPermition('pessoa.deletar') >= 100) return true;
							
						return false;
					}
			),
			
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('myself', 'index', 'equipe', 'search','json',),
				'users'=>array('@'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('restorePassword', 'admin','delete', 'search', 'addprojetoatuante'),
				'expression'=>function(){
					if (Sipesq::getPermition('pessoa.informacoes_avancadas') >= 100) return true;
					
					return false;
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
		
		
		$this->render('_fullview',array(
			'data'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Pessoa;
		
		$model->password = '';			
		if(isset($_POST['Pessoa']))
		{

			$model->attributes=$_POST['Pessoa'];
			$model->data_nascimento = Sipesq::dateRfc($model->data_nascimento);
			
			//Criptografa a senha
			if($model->validate())
				$model->password = md5($model->password);
			
			if(isset($_POST['Atividade']['projetos_atuante']))
				$model->projetos_atuante = $_POST['Pessoa']['projetos_atuante'];
				
			if($model->save()){
						
					foreach ($model->projetos_atuante as $p){
						$ppa = new ProjetoPessoaAtuante();
						$ppa->cod_pessoa = $model->cod_pessoa;
						$ppa->cod_projeto = $p;
						$ppa->save();
						unset($ppa);		
					}
					
					$this->redirect(array('view','id'=>$model->cod_pessoa));
				}
		}
		
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function actionAddProjetoAtuante($id)
	{
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		$projeto_atuante = new ProjetoPessoaAtuante();
		$projeto_atuante->cod_pessoa = $id;
		if(isset($_POST['ProjetoPessoaAtuante']))
		{
			$projeto_atuante->attributes=$_POST['ProjetoPessoaAtuante'];
			$projeto_atuante->cod_pessoa = $id;
			if($projeto_atuante->save())
				$this->redirect(array('view','id'=>$id));
		} 	
		
		$this->render('createProjetoAtuante',array(
			'model'=>$projeto_atuante,
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
		
		
		if(isset($_POST['Pessoa']))
		{
				
			
			$model->attributes=$_POST['Pessoa'];
			
			if(isset($_POST['Pessoa']['projetos_atuante'])){
				$connection=Yii::app()->db;
				$sql = "delete from projeto_pessoa_atuante where cod_pessoa = :cod_pessoa";
				$command = $connection->createCommand($sql);
				$command->bindParam(":cod_pessoa",$id,PDO::PARAM_STR);
				$command->execute();

				$model->projetos_atuante = $_POST['Pessoa']['projetos_atuante'];
			}
				
				
			
			if($model->save()){
				if(isset($_POST['Pessoa']['projetos_atuante']))
					foreach ($model->projetos_atuante as $p){
						$ppa = new ProjetoPessoaAtuante();
						$ppa->cod_pessoa = $model->cod_pessoa;
						$ppa->cod_projeto = $p;
						$ppa->save();
						unset($ppa);		
					}
				
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
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pessoa', array( 
							'pagination'=>array('pageSize'=>10,),
			
		'criteria'=>array('with'=>array('projetos_atuante'),'order'=> 'nome ASC'),
    						));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		'model'=> new Pessoa(),
		));
	}
	
	/**
	 * 
	 * Carrega a pÃ¡gina pessoal de uma pessoa logada no sistema.
	 */
	public function actionMyself(){
		$this->redirect(array("/pessoa/view/", 'id'=>Yii::app()->user->getId()));
	}
	
	/**
	 * JSON Test
	 */
	public function actionJson()
	{  
		$this->layout=false;
		//header('Content-type: application/json');

		$criteria = new CDbCriteria();
		$criteria->select = array('cod_pessoa, nome, nome_curto, email ');
		$criteria->order = 'nome';
		$criteria->limit = 20;
		
		if(isset($_GET['q'])){
			$term = CHtml::encode($_GET['q']);
			$criteria->addCondition("nome ILIKE '%{$term}%'", 'AND');	
		}
 		
		$pessoas = Pessoa::model()->findAll($criteria);
		
		echo  '[';
		$numP = count($pessoas);
		foreach($pessoas as $key=>$p){
			//echo CJSON::encode($pes);
			//echo json_encode($pes);
			$pes =  '{"name": "' .$p->nome .'", ';
			$pes .= '"id": "' . $p->cod_pessoa .'"}';
			echo $pes;
			 if($key < $numP -1){
			 	echo ',';
			 }
		}
		echo ']';
		
		Yii::app()->end();
	}
	
	
	/**
	 * Procura uma determinada Pessoa.
	 */
	public function actionSearch()
	{	
		$model=new Pessoa();
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pessoa']))
		  $model->attributes=$_GET['Pessoa'];
		
		$criteria=new CDbCriteria;
		$criteria->with = array('projetos_atuante','vinculo_institucional');
		$criteria->together = true;

		$criteria->addSearchCondition('t.nome', $model->nome,true,'OR','ILIKE');
		$criteria->addSearchCondition('projetos_atuante.nome', $model->nome,true,'OR','ILIKE');
		$criteria->addSearchCondition('vinculo_institucional.nome', $model->nome,true,'OR','ILIKE');
		$criteria->addSearchCondition('telefone', $model->nome,true,'OR','ILIKE');
		$criteria->addSearchCondition('email', $model->nome,true,'OR','ILIKE');
		$criteria->addSearchCondition('cidade', $model->nome,true,'OR','ILIKE');
//		
		$criteria->order = 't.nome ASC';

		$dataProvider=new CActiveDataProvider('Pessoa', array(
							'criteria'=>$criteria, 
							'pagination'=>array('pageSize'=>10,),
    						));
    						
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}
	
	
	/**
	 * Mostra todos os membros atuais da equipe
	*/
public function actionEquipe()
	{
		
		$dataProvider=new CActiveDataProvider('Pessoa',array(
			                'criteria' => array(
			                'condition'=>'t.equipe_atual = true',
							'order'=>'nome',
			   				),
			   				)); 
		
		
			$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=> new Pessoa(),
		));
	}
	
	

	/**
	 * Manages all models.
	 */
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
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{	
		$criteria=new CDbCriteria;
		//$criteria->with = array('projetos_atuante','vinculo_institucional');
		//$criteria->together = true;
		
		$model=Pessoa::model()->findByPk((int)$id, $criteria);
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
	
	/**
	 * 
	 * Edita o prÃ³prio login
	 */
	public function actionChangePassword()
	{
		
		$pessoa = Pessoa::model()->findByPk(Yii::app()->user->getId());

		$model=new NewLoginForm($pessoa);
		
		$model->login = $pessoa->login;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='new-login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['NewLoginForm']))
		{
			$model->attributes=$_POST['NewLoginForm'];

			if(md5($model->old_password) === $pessoa->password){
					
				$pessoa->password = md5($model->password);
				$pessoa->first_login = false;
				
				if($pessoa->save(false)){
					$this->redirect(array('/pessoa/view', 'id'=>$pessoa->cod_pessoa));
				}
				
			}else{
				$model->addError('old_password','Sua senha antiga não confere');
				
			}
				
		}
		// display the login form
		$this->render('_form_login',array('model'=>$model));
		
	}
	
	/**
	 * 
	 * Edita o prÃ³prio login
	 */
	public function actionRestorePassword($id)
	{
		$pessoa = Pessoa::model()->findByPk($id);
		
		$model=new NewLoginForm($pessoa);
		
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='new-login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['NewLoginForm']))
		{
			$model->attributes=$_POST['NewLoginForm'];
					
				$pessoa->login = $model->login;
				$pessoa->password = md5($model->password);
				
				//Senha trocada pelo Admin. O usuÃ¡rio terÃ¡ de trocar novamente a senha.
				$pessoa->first_login = true;
				
				if($pessoa->save(false)){
					$this->redirect(array('/pessoa/myself'));
				}
		}
		
		// display the login form
		$this->render('_restore_pass',array('model'=>$model));
		
	}
	
}
