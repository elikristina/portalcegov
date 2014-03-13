<?php

class AtividadeController extends Controller
{
	protected $idMenu = 'menuGerencial';
	public $activeMenu = "Atividades";
	
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
			'postOnly + delete, deletePasso', 
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		/**
		 * Syporte ou responsável
		 * 'update', 'delete','atvToday', 'atvDone', 'atvTodo', 'atvProgress','saveActivity', 'setDone'
		 * 
		 * Suporte 
		 * 'admin','index'
		 * 
		 * Qualquer pessoa logada
		 * 'create','tokenPessoa'
		 * 
		 * Qualquer pessoa que seja do Suporte, Responsavel, Participante ou que tenha algum passo da atividade
		 *  'view', 'tokenPessoa','createPasso', 'updatePasso', 'deletePasso', 'passoConcluido','loadPassos','loadColumn','loadKanbanItem'
		 */
		return array(
			array('allow',  // Qualquer pessoa logada
				'actions'=>array('create','tokenPessoa', 'calendar','loadColumn', 'index', 'excelExport'),
				'users'=>array('@'),
				//'expression'=>function($user, $rule){}
			),
			
			 
			/**
			*=======================
			* GRUPOS
			*=======================
			*/

			array('allow',  // Qualquer pessoa que seja do Suporte, Responsavel, Participante ou que tenha algum passo da atividade
				'actions'=>array('json', 'view', 'tokenPessoa','createPasso','loadPassos','loadKanbanItem'),
				'expression'=>function($user, $rule){
					//Se é alguém do suporte pode editar a atividade
					if( Sipesq::isSupport($user->getId()) 
						|| (Sipesq::getPermition('atividade.informacoes') >= 1)
						|| (Sipesq::getPermition('projeto.atividades') >= 1)
					) return true;
					
					if(isset($_GET['id'])) 
						$id = $_GET['id'];
					else return false; 
			
					$model = Atividade::model()->findByPk($id);
					if($model == null) return false;

					foreach($model->projetos as $projeto){
						if($projeto->getPermition('atividades') > 1) return true;
					}
					
					//Verifica se é responsável
					$userId = $user->getId();
					return ( $model->isResponsible($userId) || $model->isParticipating($userId) || $model->hasStep($userId) );
					
				}
			),

			array('allow',  // Qualquer pessoa que seja do Suporte, Responsavel, Participante ou que tenha algum passo da atividade
					'actions'=>array('updatePasso', 'deletePasso', 'passoConcluido'),
					'expression'=>function($user, $rule){
						//Se é alguém do suporte pode editar a atividade
						
						if( Sipesq::isSupport($user->getId()) 
							|| (Sipesq::getPermition('atividade.informacoes') >= 2)
							|| (Sipesq::getPermition('projeto.atividades') >= 2)
						) return true;
							
						if(isset($_GET['id']))
							$id = $_GET['id'];
						else return false;
							
						$model = AtividadePasso::model()->findByPk($id);
						if($model == null) return false;

						foreach($model->atividade->projetos as $projeto){
							if($projeto->getPermition('atividades') > 1) return true;
						}
							
						return ( $model->isResponsible($user->getId()) 
						    || $model->atividade->isResponsible($user->getId()
						    || $model->cod_pessoa == $user->getId())
						  );
						
						
							
					}
			),
					
			array('allow', // Suporte ou admin
				'actions'=>array('update', 'delete','atvToday', 'atvDone', 'atvTodo', 'atvProgress','saveActivity', 'setDone'),
				'expression'=>function($user, $rule){
					
					if( Sipesq::isSupport($user->getId()) 
						|| (Sipesq::getPermition('atividade.informacoes') >= 100)
						|| (Sipesq::getPermition('projeto.atividades') >= 100)
					) return true;

					if(isset($_GET['id'])) 
						$id = $_GET['id'];
					else return false; 
			
					$model = Atividade::model()->findByPk($id);
					if ($model == null) return false;

					foreach ($model->projetos as $projeto) {
						if($projeto->getPermition('atividades') >= 2) return true;
					}
					
					//Verifica se é responsável
					return $model->isResponsible($user->getId());

					return false;
				}
			),

			array('allow', // Suporte ou admin
				'actions'=>array('admin'),
				'expression'=>function($user, $rule){
					return (Sipesq::isSupport($user->getId()) || Sipesq::getPermition('atividades.informacoes') >= 100);
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($projeto=null)
	{
		$model=new Atividade;
		$model->cod_pessoa = Yii::app()->user->getId();

		if($projeto != null ) $model->projetos = $projeto;

		// Uncomment the following line if AJAX validation is needed
		 //$this->performAjaxValidation($model);

		if(isset($_POST['Atividade']))
		{
			$model->attributes=$_POST['Atividade'];
			
			//Valida projetos
			if(isset($_POST['Atividade']['projetos']))
				$model->projetos = $_POST['Atividade']['projetos'];

			//Valida pessoas
			if(isset($_POST['Atividade']['pessoas']))
				$model->pessoas = $_POST['Atividade']['pessoas'];
			
			
 			$model->cod_categoria = $_POST['Atividade']['cod_categoria'];
			
			//Atualiza a data de edição e criação
			$model->data_criacao = date('Y-m-d');
			$model->data_edicao = date('Y-m-d');
				
			if($model->save()){
					
					$this->salvaProjetos($model->cod_atividade, $model->projetos);
					$this->salvaPessoas($model->cod_atividade, $model->pessoas);
				
				$this->broadCast($model->cod_atividade, "adicionou você na atividade");
						
				$this->redirect(array('view','id'=>$model->cod_atividade));
			}


			$connection = Yii::app()->db; 
			$transaction=$connection->beginTransaction();
			try
			{
				if($model->save()){

					if(!$this->salvaProjetos($model->cod_atividade, $model->projetos))
						$model->addError('projetos', "Erro ao salvar projetos");

					if(!$this->salvaPessoas($model->cod_atividade, $model->pessoas))
						$model->addError('pessoas', "Erro ao salvar pessoas");
				
					$this->broadCast($model->cod_atividade, "adicionou você na atividade");

					if($model->hasErrors()) throw new CHttpException(500, "ERRO AO SALVAR ATIVIDADE");
					
					//Salva definitivamente todas as alterações no banco
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->cod_atividade));
			 
					
				}
			} catch (Exception $e)
			{
			    $transaction->rollBack();	
			}
				
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	private function broadCast($id, $msg){

		$model = $this->loadModel($id);
		
		$sender_id = Yii::app()->user->getId();
		$sender = Pessoa::model()->findByPk($sender_id)->nome;
		
		$message = "<b>{$sender}</b> {$msg} <b>{$model->nome_atividade}</b>";
		$url = $this->createUrl('view', array('id'=>$model->cod_atividade));

		$receivers = Array();
	
		$receivers[$model->cod_pessoa] = $model->responsavel;

		foreach($model->pessoas as $p){
			$receivers[$p->cod_pessoa] = $p;
		}

		//Não manda mensagem para o proprio criador da notificacao
		if(isset($receivers[$sender_id])) unset($receivers[$sender_id]);
		
		foreach($receivers as $pessoa){
			$ntf = new Notificacao();
			$ntf->sender = $sender_id;
			$ntf->message = $message;
			$ntf->url = $url;
			$ntf->receiver = $pessoa->cod_pessoa;
			$ntf->save(false);
		}
		
		
	}


	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be re	directed to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		

		// Uncomment the following line if AJAX validation is needed
		 $this->performAjaxValidation($model);

		if(isset($_POST['Atividade']))
		{
			$model->attributes=$_POST['Atividade'];
			
			if(isset($_POST['Atividade']['projetos']))
				$model->projetos = $_POST['Atividade']['projetos'];
				
			if(isset($_POST['Atividade']['pessoas']))	
			 $model->pessoas = $_POST['Atividade']['pessoas'];

			if(isset($_POST['Atividade']['cod_categoria']))				
				$model->cod_categoria = $_POST['Atividade']['cod_categoria'];
				

			$model->data_edicao = date('Y-m-d');

			
			
			$connection = Yii::app()->db; 
			$transaction=$connection->beginTransaction();
			try
			{
				if($model->save()){


					if(count($model->pessoas) > 0)
						if(!$this->salvaPessoas($model->cod_atividade, $model->pessoas))
							$model->addError('pessoas', "Erro ao salvar pessoas");
				
					if(count($model->projetos) > 0)
						if(!$this->salvaProjetos($model->cod_atividade, $model->projetos))
							$model->addError('projetos', "Erro ao salvar projetos");

					$this->broadCast($model->cod_atividade, "atualizou a atividade");
			 
					if($model->hasErrors()) throw new CHttpException(500, "ERRO AO SALVAR ATIVIDADE");
					
					//Salva definitivamente todas as alterações no banco
					$transaction->commit();
					$this->redirect(array('view','id'=>$model->cod_atividade));
					
				}
			} catch (Exception $e)
			{
			    $transaction->rollBack();	

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
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/site/index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($pessoa=null, $projeto=null, $categoria=null, $coordenador=null)
	{

		//define o layout
		$this->layout = '//layouts/column_atv';
		
		$this->render('index',array(		
			'projeto'=>$projeto,
			'pessoa'=>$pessoa,
			'categoria'=>$categoria,
			'coordenador'=>$coordenador,

		));
	}
	

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Atividade('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Atividade']))
			$model->attributes=$_GET['Atividade'];

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
		$model=Atividade::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='atividade-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();		
		}
	}
		
	private function salvaProjetos($cod_atividade,$projetos){
		AtividadeProjeto::model()->deleteAll('cod_atividade = '.$cod_atividade);
		foreach ($projetos as $p){
			$a = new AtividadeProjeto();
			$a->cod_atividade = $cod_atividade;
			$a->cod_projeto = $p;
			if(!$a->save()) return false;
			unset($a);		
		}
		return true;
	}

	/**
	 * 
	 * Cria um passo para uma atividade
	 * @param integer $id - Identificador da Atividade
	 */
	
	public function actionCreatePasso($id)
	{

	    $model = new AtividadePasso();
	    $model->cod_atividade = $id;
	    $model->data_criacao = date("d/m/Y");
	    
	
	    if(isset($_POST['AtividadePasso']))
	    {
	        $model->attributes=$_POST['AtividadePasso'];
	        
	        if($model->save()){

	        	$model->atividade->estagio = false;

	        	if($model->atividade->save()){
	        			        		
	        		$atv_pessoa = AtividadePessoa::model()->findByPk(array('cod_atividade'=>$model->cod_atividade, 'cod_pessoa'=>$model->cod_pessoa));

	        		if($atv_pessoa == null){
	        			$atv_pessoa = new AtividadePessoa();
	        			$atv_pessoa->cod_pessoa = $model->cod_pessoa;
	        			$atv_pessoa->cod_atividade = $model->cod_atividade;
	        			if(!$atv_pessoa->save()) throw new CHttpException(404);
	        		}

	        		$sender_id = Yii::app()->user->getId();
					$sender = Yii::app()->user->getName();					

	        		if($sender_id != $model->cod_pessoa){
	        			$notify = new Notificacao();
		        		$notify->sender = $sender_id;
		        		$notify->receiver = $model->cod_pessoa;
		        		$notify->message = "<b>{$sender}</b> adicionou o passo <b>{$model->descricao}</b> para você na atividade <b>{$model->atividade->nome_atividade}</b>";
		        		$notify->url = $this->createUrl('view', array('id'=>$model->cod_atividade));
		        		$notify->save(false);
		        		unset($notify);
	        		}
	        		
	        		

	        		$this->renderPartial('/atividade/passo/_view', array('model'=>$model));
	        	}
	        		
	        	Yii::app()->end();
	        }else{
	        	foreach($model->getErrors() as $err){
	        		echo $err[0] ."<br>";
	        	}
	        }
	        	
	    }
	    
	}
	
	/**
	 * 
	 * Edita um passo
	 * @param integer $id - Identifica o passo
	 */
	public function actionUpdatePasso($id){
		
		 $model=new AtividadePasso;
		 $model = AtividadePasso::model()->findByPk($id);
		 
		 if($model == null){
		 	throw new CHttpException('404', 'Passo não encontrado');
		 }
		 
		$this->layout=false;

	    if(isset($_POST['AtividadePasso']))
	    {
	        $model->attributes=$_POST['AtividadePasso'];
	        if($model->save())
	        {
	        		$sender_id = Yii::app()->user->getId();
					$sender = Yii::app()->user->getName();					

	        		if($sender_id != $model->cod_pessoa){
	        			$notify = new Notificacao();
		        		$notify->sender = $sender_id;
		        		$notify->receiver = $model->cod_pessoa;
		        		$notify->message = "<b>{$sender}</b> atualizou o passo <b>{$model->descricao}</b>";
		        		$notify->url = $this->createUrl('view', array('id'=>$model->cod_atividade));
		        		$notify->save(false);
		        		unset($notify);
	        		}

				$this->renderPartial('/atividade/passo/_view', array('model'=>$model));
				Yii::app()->end();
	        }
	    }
	    $this->render('/atividade/passo/_form_modal',array('model'=>$model));
		}
		
		/**
		 * 
		 * Deleta um passo
		 * @param integer $id
		 * @var $passo AtividadePasso
		 */
		public function actionDeletePasso($id){
			
			$passo = AtividadePasso::model()->findByPk($id);
			
			if($passo == null){
				throw new CHttpException('404', 'Erro ao deletar passo. Passo não encontrado');
			}
			
			$passo->delete();
			
		}
	
		
	/**
	 * 
	 * Salvas as pessoas que fazem parte desta atividade
	 * @param integer $cod_atividade
	 * @param Array $pessoas
	 */
	private function salvaPessoas($cod_atividade,$pessoas){

		AtividadePessoa::model()->deleteAll('cod_atividade = '.$cod_atividade);
		foreach ($pessoas as $p){
			$a = new AtividadePessoa();
			$a->cod_atividade = $cod_atividade;
			$a->cod_pessoa = $p;
			if(!$a->save()) return false;
			unset($a);		
		}
		return true;
	}
	
	public function actionPassoConcluido($id){
		
		$model = new AtividadePasso();
		$model = AtividadePasso::model()->findByPK($id);
		
			
	    if(isset($_POST['finalizado']))
	    {
	        $model->data_finalizacao = date('d/m/Y');
	        
	        if($_POST['finalizado'] == 'true'){
	        	$model->finalizado = true;
	        }else{
	        	$model->finalizado = false;
	        }
	        
	        if($model->save()){
	        	if($model->count('finalizado = false and cod_atividade = '.$model->cod_atividade) == 0){
	        		$model->atividade->estagio = true;
	        		$model->atividade->save();
				}else{
					$model->atividade->estagio = false;
	        		$model->atividade->save();
				}
	        	echo $this->renderPartial('/atividade/passo/_view', array('model'=>$model), true);
	        	Yii::app()->end();
	        }else{
	        	foreach($model->getErrors() as $err){
	        		echo $err[0] ."<br>";
	        	}
	        }
	        	
	    }
		
	}

	public function actionAtvToday(){
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->data_realizacao = date('Y-m-d');
		$model->estagio = false;
		$model->em_andamento = false;
		$model->save(false);
		
		$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
		Yii::app()->end();

	}

	public function actionAtvProgress(){
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->data_realizacao = date('Y-m-d');
		$model->em_andamento = true;
		$model->estagio = false;
		$model->save(false);
		
		$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
		Yii::app()->end();

	}

	public function actionAtvDone(){
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$model->em_andamento = false;
		$model->estagio = true;
		$model->save(false);
	
		$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
		Yii::app()->end();
	}

	public function actionAtvTodo(){
		$id = $_POST['id'];
		$connection = Yii::app()->db;   // assuming you have configured a "db" connection
		// If not, you may explicitly create a connection:
		// $connection=new CDbConnection($dsn,$username,$password);
		$sql = "UPDATE atividade SET data_realizacao = NULL, em_andamento=false, estagio=false WHERE cod_atividade = " .$id;
		$command = $connection->createCommand($sql);
		$command->execute();
		
		
		$model = $this->loadModel($id);
		$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
		Yii::app()->end();
		

	}

	public function actionLoadPassos(){
		
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$this->renderPartial('/atividade/passo/_passos', array('model'=>$model));
		Yii::app()->end();
	}
	
	public function actionLoadKanbanItem(){
		$id = $_POST['id'];
		$model = $this->loadModel($id);
		$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
		Yii::app()->end();
	}


	/**
	* Salva uma atividade via ajax
	* recebe como parâmetros 
	* @param int id - identificador da atividade
	* @param int status - status que a atividade vai receber: 0 - Todo; 1 - Today; 2 - Done
	*
	*/
	public function actionSaveActivity(){
		//Se nao for ajax encerra o app
		if(Yii::app()->request->isPostRequest)
		{
			
			$id = $_POST['id'];
			$status = $_POST['status'];
			$model = $this->loadModel($id);

			

			$model->status = $status;

			//Salva a data de realização caso tenha ficado pronta
			if($model->status == 2){
				$model->data_realizacao = date('Y-m-d');
			}
			$model->data_edicao = date('Y-m-d');

			//Salva a atividade
			if($model->save(false)){
				$this->renderPartial('/atividade/_kanban_item', array('data'=>$model));
				Yii::app()->end();	
			}else{
				throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
			}

			
		}else{
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		}
		

	}



	/**
	* Carrega as atividades de uma determinada coluna (done, today, todo) via AJAX
	* @param array options - array de parametros como:
	* coluna (done, today, todo), projeto, coordenador, participante, etc
	* $pessoa=null, $projeto=null, $categoria=null, $coordenador=null, $status
	*
	*/
	public function actionLoadColumn(){

		$this->layout = '//layouts/ajax';
		
		
		
		if(isset($_POST['options']))
			$options = $_POST['options'];	

		//Instancia todos as criterias - uma para cada coluna	
		$criteria =new CDbCriteria;
		$criteria->together = true;		
		$criteria->with = array('passos', 'categoria','pessoas','projetos');
		$criteria->order = 't.data_criacao, nome_atividade';

		if(isset($options['categoria'])){
			$criteria->compare('categoria.cod_categoria_pai', $options['categoria']);
		}

		if(isset($_POST['status'])){
			$criteria->compare('t.status', $_POST['status']);
			if($_POST['status'] == '2'){
				$criteria->limit = 10;
			}			

		}



		if(isset($_POST['status'])){
			$criteria->compare('t.status', $_POST['status']);			

		}



		if(isset($options['pessoa'])){
			$pessoa = $options['pessoa'];
		}else{
			$pessoa = Yii::app()->user->getId();	
		}

		$condition = 't.cod_pessoa = ' .$pessoa .'OR (passos.cod_pessoa = ' .$pessoa .' AND passos.finalizado=false)';
			$criteria->addCondition($condition,'AND');




		if(isset($options['projeto'])){

			$criteria->compare('projetos.cod_projeto', $options['projeto']);

		}

		$dataProvider = new CActiveDataProvider('Atividade', 
		array(
			'criteria'=>$criteria,
			//'pagination'=>array('pageSize'=>9999,),
			'pagination'=>false,
		));
		$this->widget('zii.widgets.CListView', array(
				'dataProvider'=>$dataProvider,
				'itemView'=>'_kanban_item',
				'summaryText'=>'',
				'emptyText'=>'',
			));
		Yii::app()->end();

	}

	/**
	 * 
	 * Seta uma atividade como pronta
	 */
	public function actionSetDone(){
		$models = Atividade::model()->findAll();
		foreach($models as $model){
			if($model->estagio){
				$model->status = 2;
				$model->save(false);
			}

			if($model->data_realizacao == date('Y-m-d')){
				$model->status = 1;
				$model->save(false);
			}

		}


	}
	
	/**
	 * 
	 * Retorna JSON de todas as pessoas desta atividade
	 * @param integer $id - identificador da Atividade
	 */
	public function actionTokenPessoa($id){
		
		$model = new Atividade();
		$model = Atividade::model()->findByPk($id);
		
		if($model == null){
			throw new CHttpException('404');
		}
		echo '[';
		$num = count($model->pessoas);
		foreach ($model->pessoas as $i=>$p){
			echo "{\"id\": \"" .$p->cod_pessoa ."\", \"name\": \"" .$p->nome ."\"}";
			if($i < $num -1)
				echo ',';
		}
		echo ']';
		
		
	} 
	
	/**
	 * Renderiza o json para o calendario
	 */	
	public function actionCalendar($id=null){
		
		$from = strtotime(date('Y-m-d')) * 1000 - 3600*24*15*1000; // 15 dias antes
		$to = strtotime(date('Y-m-d')) * 1000 + 3600*24*15*1000; // 15 dias depois
		
		if(isset($_POST["from"]) && isset($_POST["to"])){
			$from = $_POST["from"];
			$to = $_POST["to"]; 
		}

		$atividades = array();
		$projetos = array();
		$passos = array();
		$atividades = Calendar::atividades($from, $to, $id);
		$projetos = Calendar::projetos($from, $to, $id);
		$passos = Calendar::passos($from, $to, $id);


		$calendarData = array(
				 'success'=>1
				, 'result'=> array_merge($atividades, $projetos, $passos)
		);
		
		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($calendarData);
		Yii::app()->end();
		
	}


	
	/**
	 * 
	 * @param integer $id - cod_pessoa
	 */
	public function actionJson(){

		$this->layout =false;
		
		$count = 0;
		$command =  Yii::app()->db->createCommand();
		$select = array(
					'atividade.cod_atividade as id'
				,	'nome_atividade'
				,	'descricao' 
				,	'data_inicio'
				,	'data_fim'
				,	'atividade.cod_pessoa as responsavel'
				,	'atividade_categoria.nome as categoria'
				,	'pessoa.nome as responsavel_nome'
				,	'estagio'
		);
		
		$params = array();
		$where = array();
				
		$command->leftJoin("atividade_categoria","atividade.cod_categoria = atividade_categoria.cod_categoria");
		$command->leftJoin("pessoa","atividade.cod_pessoa = pessoa.cod_pessoa");
		
		
		if(isset($_GET['pessoa']) && $_GET['pessoa'] != ''){
			
			$command->leftJoin("atividade_pessoa","atividade_pessoa.cod_atividade = atividade.cod_atividade");
			$select[] =  "atividade_pessoa.cod_pessoa as participante";
			$params['pessoa'] = $_GET['pessoa']; 
			
			if(count($where) < 1)
				$where[] = "atividade_pessoa.cod_pessoa = :pessoa";
			else
				$where[] = "AND atividade_pessoa.cod_pessoa = :pessoa";
			
		}
		
		if(isset($_GET['responsavel'])&& $_GET['responsavel'] != ''){
				
			$params['responsavel'] = $_GET['responsavel'];
				
			if(count($where) < 1)
				$where[] = "atividade.cod_pessoa = :responsavel";
			else
				$where[] = "AND atividade.cod_pessoa = :responsavel";
				
		}
		
		
		if(isset($_GET['projeto']) && $_GET['projeto'] != ''){
			
			$command->leftJoin("atividade_projeto","atividade_projeto.cod_atividade = atividade.cod_atividade");
			$select[] =  "atividade_projeto.cod_projeto as participante";
			$params['projeto'] = $_GET['projeto'];
			
			if(count($where) < 1)
				$where[] = "atividade_projeto.cod_projeto = :projeto";
			else
				$where[] = "AND atividade_projeto.cod_projeto = :projeto";
				
		}
		
		if(isset($_GET['categoria']) && $_GET['categoria'] != ''){
			
			$params['categoria'] = $_GET['categoria'];
				
			if(count($where) < 1)
				$where[] = "atividade.cod_categoria = :categoria";
			else
				$where[] = "AND atividade.cod_categoria = :categoria";
		
		}
		
		if(isset($_GET['count']) && $_GET['count'] != ''){
			$count = $_GET['count'];
		}
		
		
		if(isset($_GET['estagio']) && $_GET['estagio'] != ''){
			
			$params['estagio'] = $_GET['estagio'];
			
			if(count($where) < 1)
				$where[] = "atividade.estagio = :estagio";
			else 
				$where[] = "AND atividade.estagio = :estagio";
		}
				
		
		//MONTA O SQL
		$command->from('atividade');
		$command->params = $params;
		$command->where = implode(' ', $where);
		$command->select = implode(', ', $select);
		$command->order = 'atividade.data_fim ASC';
		$command->limit(10, $count);
		
		$results = $command->queryAll();
		
		$atvs = array_map(
			function($atv){
				return array(
							'cod_atividade'=>$atv['id']
						,	'nome'=>$atv['nome_atividade']
						,	'categoria'=>$atv['categoria']
						,	'data_inicio'=>$atv['data_inicio']
						,	'data_fim'=>$atv['data_fim']
						,	'descricao'=>$atv['descricao']
						,	'responsavel'=>$atv['responsavel_nome']
						, 	'url'=>Yii::app()->createUrl('/atividade/view', array('id'=>$atv['id']))
						,	'status'=>$atv['estagio'] ? 'Finalizada' : 'A Fazer'
			);
			}
			
		,	$results);
		
		header('Content-type: application/json');
		echo json_encode($atvs);
		Yii::app()->end();
		
	}

	public function actionExcelExport(){

		$command =  Yii::app()->db->createCommand();

		$command->select = 'nome_atividade as atividade, projeto.nome as projeto, atividade.data_fim, atividade.estagio, projeto.data_inicio as inicio_projeto, projeto.data_fim as fim_projeto';
		$command->from('projeto, atividade, atividade_projeto');
		$command->where = 'atividade.cod_atividade = atividade_projeto.cod_atividade AND projeto.cod_projeto = atividade_projeto.cod_projeto';
		$command->order = 'projeto.nome, atividade.data_fim ASC, atividade.nome_atividade';

		//Return array
		$results = $command->queryAll();

		echo "<table border='1'>";
		foreach ($results as $item) {
				echo implode(" ", array(
					"<tr><td>",				
					date('d/m/Y', strtotime($item['data_fim'])),
					"</td><td>",
					$item['atividade'],
					"</td><td>",
					$item['projeto'],
					"</td><td>",
					$item['estagio'] ? 1 : 0,
					"</td><td>",
					date('d/m/Y', strtotime($item['inicio_projeto'])),
					"</td><td>",
					"</td><td>",
					date('d/m/Y', strtotime($item['fim_projeto'])),
					"</td><td>",
					"</td></tr>"
				));
		}
		echo "</table>";	
	}
	

}
