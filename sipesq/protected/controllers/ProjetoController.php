<?php

class ProjetoController extends Controller
{
	protected $idMenu = 'menuGerencial';
	public $activeMenu = "Projetos";
	
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

			/**
			*==============================
			* FINANCEIRO
			*==============================
			**/
		
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
					'actions'=>array('tabFinanceiro','relatorio','financeiro', 'ajaxDespesas', 'jsonFinanceiro', 'morrisData', 'jsonRubricas'),
					'expression'=> function(){

						if(isset($_GET['id'])){
							$model = $this->loadModel($_GET['id']);
							return (Sipesq::isAdmin() || $model->getPermition('financeiro') >=1);
						}

						//Se for admin já retorna permissão de acesso
						if(Sipesq::isAdmin() || Sipesq::getPermition('projeto.financeiro') >= 1)
							return true;

						if(isset($_GET['projeto'])){
							$model = $this->loadModel($_GET['projeto']);
							return (Sipesq::isAdmin() || $model->getPermition('financeiro') >=1);
						}
						
						return false;
					},
			),

			/**
			*==============================
			* DOCUMENTOS
			*==============================
			**/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('deleteFile'),
					'expression'=> function(){

						if(isset($_GET['id'])){
							$model = ProjetoArquivo::model()->findByPk($_GET['id']);
							if($model->projeto->getPermition('documentos') >= 100) return true;
						}

						return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.documentos') >= 100);
					},
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('updateFile'),
					'expression'=> function(){
						if(isset($_GET['id'])){
							$model = ProjetoArquivo::model()->findByPk($_GET['id']);
							if($model->projeto->getPermition('documentos') >= 2) return true;
						}
						return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.documentos') >= 2);
					},
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('createFile'),
					'expression'=> function(){
						if(isset($_GET['id'])){
							$model = Projeto::model()->findByPk($_GET['id']);
							if($model->getPermition('documentos') >= 2) return true;
						}
						return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.documentos') >= 2);
					},
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('docs', 'downloadFile'),
					'expression'=> function($user, $rules){
						
						if (isset($_GET['id'])){
							$model = Projeto::model()->findByPk($_GET['id']);
							if ($model->getPermition('documentos') >= 1) return true;							
							if ($model->isMember($user->getId())) return true;
						}
						return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.documentos') >= 1);
					},
			),
			/**
			*==============================
			* ATIVIDADES
			*==============================
			**/
			
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('atividades', 'tabAtividades'),
					'expression'=> function($user, $rules){
						if(isset($_GET['id'])){

							$model = $this->loadModel($_GET['id']);
							return (Sipesq::isAdmin() || $model->isMember($user->getId()) || $model->getPermition('atividades') >= 1);
						}

						return (Sipesq::isAdmin()|| $model->isMember($user->getId())|| Sipesq::getPermition('projeto.atividades') >= 1);
					},
			),

			/**
			*==============================
			* INFORMACOES
			*==============================
			**/
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('info', 'view', 'index', 'excelExport'),
					'expression'=> function($user, $rules){

						if(isset($_GET['id'])){
							$model = $this->loadModel($_GET['id']);

							return (Sipesq::isAdmin() || $model->isMember($user->getId()) || $model->getPermition('informacoes') >=1);
						}

						return (Sipesq::isAdmin() || Sipesq::getPermition('projeto.informacoes') >= 1);
					},
			
			
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'create' , 'setMembro'),
				'expression'=> function(){

							//http://localhost/sipesq/index.php/projeto/updatepermissao?pessoa=119&projeto=28
							if(isset($_GET['id'])){
								$model = $this->loadModel($_GET['id']);
								return (Sipesq::isAdmin() || $model->getPermition('informacoes') >=2);
							}	

						
							//Se for admin já retorna permissão de acesso
							if(Sipesq::isAdmin() || Sipesq::getPermition('projeto.informacoes') >= 2)
								return true;
			
							//verifica se o usuario é um dos coordenadores
							//if(Projeto::model()->count('cod_projeto = :proj AND (cod_professor = :id OR cod_grad = :id OR cod_pos_grad = :id)', array('id'=>$pessoa, 'proj'=>$projeto)) > 0) return true;
							//verifica se o usuário está inscrito em uma permissão maiour ou igual a de SUPORTE.	
							//if(PermissaoProjeto::model()->count('cod_projeto = :projeto AND cod_pessoa = :id AND nivel_permissao >= :nivel', array('id'=>$pessoa, 'projeto'=>$projeto, 'nivel'=>Sipesq::SUPPORT_PERMITION)) > 0) return true;
								
							//Usuario negado
							return false;				
				},
				
				
			),

			/**
			*==============================
			* GERENCIAL
			*==============================
			**/
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('permissoes', 'deletePermissao', 'gerencial', 'updatePermissao'),
				'expression'=> function(){

							if(isset($_GET['id'])){
								$model = $this->loadModel($_GET['id']);
								return (Sipesq::isAdmin() || $model->getPermition('informacoes') >=2);
							}	

							//Se for admin já retorna permissão de acesso
							if(Sipesq::isAdmin() ||Sipesq::getPermition('projeto.gerencial') >= 100) return true;

							return false;

				},
			
			),
			
			
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'delete'),
				'expression'=> function(){
					
						if(isset($_GET['id'])){
								$model = $this->loadModel($_GET['id']);
								return (Sipesq::isAdmin() || $model->getPermition('informacoes') >=2);
						}	
						return Sipesq::isAdmin() || (Sipesq::getPermition('projeto.deletar') >= 100);			
				},
			
			),

			/**
			*==============================
			* COMPORTAMENTO PADRAO
			*==============================
			**/
			array('deny',  // deny all users
				'users'=>array('*'),
				'message'=>'Você não tem permissão para realizar esta operação. Entre em contato com o coordenador do projeto',
			),

			array('allow', // allow authenticated user to perform 'create' and 'update' actions
					'actions'=>array('json', 'calendar', 'grantt', 'oldGrantt', 'index', 'renderChart'),
					'users'=>array('@') ,					
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		return $this->actionInfo($id);
		/*
		$model = Projeto::model()->findByPk($id);
		
		$this->render('view',array(
			'model'=>$model,
		));*/
	
	}

	/**
	*	Carrega a aba de atividades por AJAX
	*	@param int $id - identificador do projeto
	*   
	*/
	public function actionTabAtividades($id){			
		
			$model = Projeto::model()->findByPk($id);
			
			/*
			//Verifica a permissão dos usuários.
			if(!in_array(Yii::app()->user->name, array_merge($model->loginsPermitidos(PermissaoProjeto::READ_PERMITION) , Yii::app()->params['admins'])))
				throw new CHttpException(401,'Acesso Negado. Você não está permitido a fazer esta operação.');
			*/
			
			//Enontra todas as atividades deste projeto
			$atividades = Atividade::model()->with('projetos')->findAll(array('condition'=>'projetos.cod_projeto = ' .$id, 'order'=>' t.data_fim desc, status asc'));
			
			$this->renderPartial('/atividade/_accordion_view', array('atividades'=>$atividades));
			/*
			//renderiza na tela as atividades
			foreach ($atividades as $key => $atv) {
				$this->renderPartial('/atividade/_view', array('data'=>$atv));
			}
			*/			
			Yii::app()->end();		
			
	}


	/**
	*	Carrega a aba financeira por AJAX
	*	@param int $id - identificador do projeto
	*   
	*/
	public function actionTabFinanceiro($id){

			$model = Projeto::model()->findByPk($id);
			
			$this->layout = false;

			$this->renderPartial("_view_financeiro_new", array("model"=>$model));
			
			Yii::app()->end();		
	}

public function actionRenderChart(){
	
	Yii::setPathOfAlias('gchart',Yii::getPathOfAlias('application.vendors.gchart'));
	
	$lineChart = new gchart\gLineChart(200,200);
	$lineChart->addDataSet(array(120,131,135,160,129,22,190));
	$lineChart->setLegend(array('Nice figures'));
	$lineChart->setColors(array('ED237A'));
	$lineChart->setVisibleAxes(array('x','y'));
	$lineChart->setDataRange(0,200);
	$lineChart->setLegendPosition('t');
	// axisnr, from, to, step
	$lineChart->addAxisRange(0,0,28,7);
	$lineChart->addAxisRange(1,0,200);
	
	$lineChart->setGridLines(25,10);
	$lineChart->renderImage(true);
	//$lineChart->renderImage(false)
}
	
/**
 * 
 * Relatório de projeto
 * @param integer $id
 */
	
public function actionRelatorio($id)
	{
		
		
		$model = Projeto::model()->findByPk($id);
		
		if( $model == null ) throw new CHttpException(404);	
		
		$this->layout = "//layouts/relatorio";
		
		$this->render('relatorio/relatorio',array('model'=>$model));

		/*
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		
		# You can easily override default constructor's params
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4');
		
				# render (full page)
		$content = $this->render('relatorio/relatorio',array('model'=>$model), true);
		$mPDF1->WriteHTML($content);
		
				# Load a stylesheet
				$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/bootstrap/bootstrap.min.css');
				$mPDF1->WriteHTML($stylesheet, 1);
		
		$mPDF1->Output();
		
		*/
		
		//Yii::app()->end();
		
		
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Projeto;
		$model->instrumento_juridico = new InstrumentoJuridico();
		$model->convenio = new Convenio();
		$user_id = Yii::app()->user->getId();
		
		//Define por padrão o usuario que esta criando o projeto
		$model->cod_professor = $user_id;
		$model->cod_grad = $user_id;
		$model->cod_pos_grad = $user_id;
		$model->cod_bolsista_responsavel = $user_id;

		/*
		$model->data_inicio = date("d/m/Y");
		$model->data_fim = date("d/m/Y");
		$model->data_relatorio = date("d/m/Y");
		*/
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		

		if(isset($_POST['Projeto']))
		{
			$model->attributes=$_POST['Projeto'];
			
			if(isset($_POST['Projeto']['pessoas'])){
				$model->pessoas = $_POST['Projeto']['pessoas'];
			}

			
			if(isset($_POST['InstrumentoJuridico'])){
				$model->instrumento_juridico = json_encode($_POST['InstrumentoJuridico']);
			}

			if(isset($_POST['Convenio'])){
				$model->convenio = json_encode($_POST['Convenio']);
			}
			
			
			if(isset($_POST['Orcamento'])){
				$model->orcamentos = $_POST['Orcamento'];
				
			} 
			

			//$connection = Yii::app()->db; 
			//$transaction=$connection->beginTransaction();

			//try
			//{
				if($model->save()){

					
					if(!$this->salvaOrcamento($model->cod_projeto, $model->orcamentos))
							$model->addError('orcamentos', "Erro ao salvar orçamentos");

					if(!$this->salvaPessoas($model->cod_projeto, explode(',', $model->pessoas))) 
						$model->addError('pessoas', "Erro ao adicionar equipe: Verifique os participantes e coordenadores");

					//Verifica erros e gera exceção
					if($model->hasErrors()) throw new CHttpException(500, "ERRO AO SALVAR PROJETO");
					
					//Notifica usuarios
					//$this->broadCast($model->cod_projeto, "adicionou você ao projeto");

					//Salva definitivamente todas as alterações no banco
					//$transaction->commit();

					//Redireciona
					$this->redirect(array('view','id'=>$model->cod_projeto));
					
				}
			/*} catch (Exception $e)
			{
			    $transaction->rollBack();	
			    $model->instrumento_juridico = InstrumentoJuridico::load(json_decode($model->instrumento_juridico));
				$model->convenio = Convenio::load(json_decode($model->convenio));	
			} */
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
		
		if(isset($_POST['Projeto']))
		{
			if(isset($_POST['Projeto']['pessoas'])){
				$model->pessoas =  $_POST['Projeto']['pessoas'];
			}
			
			
			$orcamentos = null;
			if(isset($_POST['Orcamento'])){
				$orcamentos = $_POST['Orcamento'];
			
			}

			if(isset($_POST['InstrumentoJuridico'])){
				$model->instrumento_juridico = json_encode($_POST['InstrumentoJuridico']);
			}

			if(isset($_POST['Convenio'])){
				$model->convenio = json_encode($_POST['Convenio']);
			}

			$model->attributes=$_POST['Projeto'];

			$connection = Yii::app()->db; 
			$transaction=$connection->beginTransaction();

			try
			{
			    //Retira a permisssão do coordenador antigo
				//$this->deleteDafaultPermissions($model);

			    if($model->save()){
					
					if(!$this->salvaOrcamento($model->cod_projeto, $orcamentos))
						$model->addError('orcamentos', "Erro ao salvar orçamentos");
					
					//Atualiza permissão do coordenador
					//$this->createDafaultPermissions($model);

					if(!$this->salvaPessoas($model->cod_projeto, explode(',', $model->pessoas))) 
						$model->addError('pessoas', "Erro ao adicionar equipe");

					//Verifica erros e gera exceção
					if($model->hasErrors()) throw new CHttpException(500, "ERRO AO SALVAR PROJETO");

					//Salva definitivamente todas as alterações no banco
					$transaction->commit();
					//Redireciona
					$this->redirect(array('view','id'=>$model->cod_projeto));

				}
			}
			catch(Exception $e) // uma exceção é disparada caso uma das consultas falhe
			{
			    $transaction->rollBack();	
			    $model->instrumento_juridico = InstrumentoJuridico::load(json_decode($model->instrumento_juridico));
				$model->convenio = Convenio::load(json_decode($model->convenio));	
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
		//Deleta apenas se for um request do tipo POST
		if(Yii::app()->request->isPostRequest)
		{
		
			$model = $this->loadModel($id);
			
			 //	Deleta o projeto
			 $model->delete();
				
				
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex($situacao=0)
	{	$criteria = new CDbCriteria();
	
		/*/Se o usuário não for admin ou do suporte só mostra os seus próprios projetos
		if(Pessoa::getAccessLevel(Yii::app()->user->getId()) < Sipesq::SUPPORT_PERMITION){
			$criteria->with = array('pessoas');
			$criteria->together = true;
			$criteria->addCondition(
				'pessoas.cod_pessoa = :cod_pessoa
				 OR t.cod_pos_grad = :cod_pessoa
				 OR t.cod_grad = :cod_pessoa
				 OR t.cod_professor = :cod_pessoa', 'AND');
			$criteria->params = array('cod_pessoa'=>Yii::app()->user->getId());
		}	*/
		
		$criteria->compare('situacao', $situacao);
		
		$dataProvider=new CActiveDataProvider('Projeto',array('criteria'=>$criteria));
			   				
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'situacao'=>$situacao
		));
	}
	
	/**
	 * Mostra todos os projetos finalizados 
	 */
	public function actionFinalizados()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 't.nome';
		$criteria->with = 'pessoas';
		$criteria->together = true;
		$criteria->addCondition('finalizado = true', 'AND');
		
		
		//Verifica se tem permissão para ver todos os projetos
		if(Pessoa::getAccessLevel(Yii::app()->user->getId()) < Sipesq::SUPPORT_PERMITION){
			$criteria->addCondition(
				'pessoas.cod_pessoa = :cod_pessoa
				 OR t.cod_pos_grad = :cod_pessoa
				 OR t.cod_grad = :cod_pessoa
				 OR t.cod_professor = :cod_pessoa', 'AND');
			$criteria->params = array('cod_pessoa'=>Yii::app()->user->getId());
		}
		
		$dataProvider=new CActiveDataProvider('Projeto', array('criteria'=>$criteria));
			   				
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	/**
	 * Mostra todos os projetos ativos
	 */
	
	public function actionAtivos()
	{
		$criteria = new CDbCriteria();
		$criteria->order = 't.nome';
		$criteria->with = 'pessoas';
		$criteria->together = true;
		$criteria->addCondition('finalizado = false', 'AND');
		
		
		//Verifica se tem permissão para ver todos os projetos
		if(Pessoa::getAccessLevel(Yii::app()->user->getId()) < Sipesq::SUPPORT_PERMITION){
			$criteria->addCondition(
				'pessoas.cod_pessoa = :cod_pessoa
				 OR t.cod_pos_grad = :cod_pessoa
				 OR t.cod_grad = :cod_pessoa
				 OR t.cod_professor = :cod_pessoa', 'AND');
			$criteria->params = array('cod_pessoa'=>Yii::app()->user->getId());
		}
		
		$dataProvider=new CActiveDataProvider('Projeto', array('criteria'=>$criteria));
			   				
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	/**
	 * Deleta as permissões padrão para Bolsista Responsável e Coordenador
	 * @param Projeto $projeto - projeto que será atualizado
	 */
	 private function deleteDafaultPermissions($projeto){
	 	
	 	//deleta a permissao do professor
	 	$coordenador = PermissaoProjeto::model()->find('cod_pessoa = :pessoa AND cod_projeto = :projeto', array('pessoa'=>$projeto->cod_professor, 'projeto'=>$projeto->cod_projeto));
	 	if($coordenador != null){
	 		$coordenador->delete();
	 		
	 	}
	 	
	 	//Deleta a permissao do pos-graduando
	 	$responsavel = PermissaoProjeto::model()->find('cod_pessoa = :pessoa AND cod_projeto = :projeto', array('pessoa'=>$projeto->cod_pos_grad, 'projeto'=>$projeto->cod_projeto));
	 	if($responsavel != null){
	 		$responsavel->delete();
	 	}
	 	
	 //Deleta a permissao do graduando
	 	$responsavel = PermissaoProjeto::model()->find('cod_pessoa = :pessoa AND cod_projeto = :projeto', array('pessoa'=>$projeto->cod_grad, 'projeto'=>$projeto->cod_projeto));
	 	if($responsavel != null){
	 		$responsavel->delete();
	 	}
	 	
	 }
	 
	/**	
	 * Cria as permissões padrão para Bolsista Responsável e Coordenador
	 * @param Projeto $projeto - projeto que será atualizado
	 * @return boolean - se todas as alterações foram efetivas
	 */
	 private function createDafaultPermissions($projeto){
	 	//Atualiza permissão do professor responsavel
		$permissao_professor = new PermissaoProjeto();
		$permissao_professor->cod_projeto = $projeto->cod_projeto;
		$permissao_professor->cod_pessoa = $projeto->cod_professor;
		$permissao_professor->nivel_permissao = PermissaoProjeto::READ_WRITE_DELETE_PERMITION;
		
		if(!$permissao_professor->save())
			return false;
		unset($permissao_professor);
		
		//Atualiza permissão do pos-graduando responsavel
		$permissao_pos_grad = new PermissaoProjeto();
		$permissao_pos_grad->cod_projeto = $projeto->cod_projeto;
		$permissao_pos_grad->cod_pessoa = $projeto->cod_pos_grad;
		$permissao_pos_grad->nivel_permissao = PermissaoProjeto::READ_WRITE_DELETE_PERMITION;
		
		if(!$permissao_pos_grad->save())
			return false;
		unset($permissao_pos_grad);
		
	 	//Atualiza permissão do graduando responsavel
		$permissao_grad = new PermissaoProjeto();
		$permissao_grad->cod_projeto = $projeto->cod_projeto;
		$permissao_grad->cod_pessoa = $projeto->cod_grad;
		$permissao_grad->nivel_permissao = PermissaoProjeto::READ_WRITE_PERMITION;
		
		if(!$permissao_grad->save())
			return false;
		unset($permissao_grad);
		
		//Tudo ocorreu bem
		return true;
		
	 }
	
	/**
	 * Gerencia as permissões dos usuários nos projetos
	 * @param integer $id - identificador do projeto
	 */
	public function actionPermissoes($id){
		
		$model = new PermissaoProjeto();
		$model->cod_projeto = $id;
		$model->permissao = new PermissaoProjetoForm();
		$perm_model = new PermissaoProjetoForm();
		
		if(isset($_POST['PermissaoProjeto']))
		{
			$model->attributes=$_POST['PermissaoProjeto'];

			if(isset($_POST['PermissaoProjetoForm']))
				$model->permissao = json_encode($_POST['PermissaoProjetoForm']);

			if($model->save())
				$this->redirect(array('gerencial', 'id'=>$id));
			else
				$model->permissao = $perm_model->load(json_decode($model->permissao));
		}
		
			//Renderiza a página de permissões confome o projeto
			$projeto = Projeto::model()->findByPk($id);
	
			if($projeto == null) throw new CHttpException(404,'Página não encontrada.');
			
			$this->render('forms/_form_permissao', array('projeto'=>$projeto, 'model'=>$model));	
		
	}

	/**
	 * Gerencia as permissões dos usuários nos projetos
	 * @param integer $id - identificador do projeto
	 */
	public function actionUpdatePermissao($id, $pessoa){
		
		$model = PermissaoProjeto::model()->findByPk(array('cod_projeto'=>$id, 'cod_pessoa'=>$pessoa));		
		$perm_projeto = new PermissaoProjetoForm();
		$model->permissao = $perm_projeto->load(json_decode($model->permissao));
		
		if(isset($_POST['PermissaoProjeto']))
		{
			
			$model->attributes=$_POST['PermissaoProjeto'];

			if(isset($_POST['PermissaoProjetoForm']))
				$model->permissao = json_encode($_POST['PermissaoProjetoForm']);

			if($model->save())
				$this->redirect(array('/projeto/gerencial', 'id'=>$id));
			else
				$model->permissao = $perm_projeto->load(json_decode($model->permissao));				
		}								
			
		$this->render('forms/_form_permissao', array('projeto'=>$model->projeto, 'model'=>$model));	
		
	}
	
	
	/**
	 * 
	 * Deleta uma permissão
	 * @param integer $id
	 * @throws CHttpException
	 */
	public function actionDeletePermissao($id, $cod_pessoa)
	{
			if(!Yii::app()->request->isPostRequest) throw new CHttpException(403);
			
			$model = PermissaoProjeto::model()->findByPk(array('cod_pessoa'=>$cod_pessoa, 'cod_projeto'=>$id));

			if($model ==null) throw new CHttpException('404');

			 //	Deleta o projeto
			 $model->delete();
			$this->redirect(isset($_GET['returnUrl']) ? $_GET['returnUrl'] : array('index'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Projeto('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Projeto']))
			$model->attributes=$_GET['Projeto'];

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
		$model=Projeto::model()->findByPk((int)$id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='projeto-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	/**
	 * Salva todas as pessoas do projeto
	 * @param unknown $cod_projeto
	 * @param unknown $pessoas
	 */
	private function salvaPessoas($cod_projeto,$pessoas){

			ProjetoPessoaAtuante::model()->deleteAll('cod_projeto = '.$cod_projeto);
			foreach ($pessoas as $p){
				$a = new ProjetoPessoaAtuante();
				$a->cod_projeto = $cod_projeto;
				$a->cod_pessoa = $p;
				if(!$a->save()) return false;
				unset($a);		
			}
		
		return true;
	}
	
	
	/**
	 * Salva todas as pessoas do projeto
	 * @param integer $cod_projeto
	 * @param Array $rubricas - Array associativo array('valor'=>X,'cod_rubrica'=>Y)
	 * @return boolean - caso todas as alterações tenham sido efetivas. Util para fazer transactions
	 */
	private function salvaOrcamento($cod_projeto, $rubricas){

		$rows = ProjetoOrcamento::model()->deleteAll('cod_projeto = '.$cod_projeto);

		if($rubricas === null)
			return true;
		
		foreach($rubricas as $r){
			
			$orc = new ProjetoOrcamento();
			$orc->cod_rubrica = $r['cod_rubrica'];
			$orc->cod_projeto = $cod_projeto;
			$orc->valor = $r['valor'];

			//erro ao salvar -> retorna false
			if(!$orc->save()) return false;
			
			unset($orc);
		}
		
		return true;
	}
	
	
	
	/**
	 * Imprime o grafico de grantt das atividades de um projeto
	 * @param $id - codigo do projeto
	 */
	public function actionGrantt($id)
	{

		$this->layout='//layouts/grantt';
		$model = Projeto::model()->findByPk($id);		
		$this->render('atividades', array('model'=>$model));
	}
	
/**
	 * Imprime o grafico de grantt das atividades de um projeto
	 * @param $id - codigo do projeto
	 */
	public function actionOldGrantt($id)
	{
		$this->layout='//layouts/column1';		
		$model = Projeto::model()->findByPk($id);
		$this->render('atividades', array('model'=>$model));
	}
	
	/**
	 * Adiciona um arquivo
	 * @param id - Identificador do projeto 
	 */
	public function actionCreateFile($id)
	{
		//Pasta onde as imagens serão salvas.
		$dir = Yii::getPathOfAlias('application.data.projetos');
		
	    $model=new ProjetoArquivo;
	    $model->cod_projeto = $id;
	    $model->file = '123';
	
	    // uncomment the following code to enable ajax-based validation
	  
	
	    if(isset($_POST['ProjetoArquivo']))
	    {
	    	$model->attributes=$_POST['ProjetoArquivo'];
	    	
	    	//Carrega o arquivo de documento.
			$model->file = CUploadedFile::getInstance($model,'file');
			if($model->validate()){
				$model->filename = $model->file->name;
				$model->extensionName = $model->file->extensionName;
				$model->size = $model->file->size;
				$model->type = $model->file->type;
				$model->file->saveAs($dir .DIRECTORY_SEPARATOR .$model->file->name);
				$model->href = Yii::app()->request->baseUrl .'/protected/data/projetos/' .$model->filename; 
				
				Yii::getPathOfAlias('webroot.protected.data.projetos') .DIRECTORY_SEPARATOR .$model->filename;
			}											
							
	    	
	        
	        if($model->save())
	        {
				$this->redirect(array('/projeto/docs', 'id'=>$id));	            
	        }
	    }
	    $this->render('forms/_form_arquivo',array('model'=>$model, 'projeto'=>$this->loadModel($id)));
	}
	
/**
	 * Adiciona um arquivo
	 * @param id - Identificador do projeto 
	 */
	public function actionUpdateFile($id)
	{
		/** @var Projeto $model */
	    
	    $model = ProjetoArquivo::model()->findByPk($id);
	
	    if(isset($_POST['ProjetoArquivo']))
	    {
	        $model->attributes=$_POST['ProjetoArquivo'];
	        
	        $dir = Yii::getPathOfAlias('application.data.projetos');
	        
	        $model->file = CUploadedFile::getInstance($model,'file');
			if($model->file != null){
				
				if(file_exists($dir .DIRECTORY_SEPARATOR .$model->filename))
					unlink($dir .DIRECTORY_SEPARATOR .$model->filename);
				
				$model->filename = $model->file->name;
				$model->extensionName = $model->file->extensionName;
				$model->size = $model->file->size;
				$model->type = $model->file->type;
				$model->file->saveAs($dir .DIRECTORY_SEPARATOR .$model->file->name);
				$model->href = Yii::app()->request->baseUrl .'/protected/data/projetos/' .$model->filename; 
				
			}			
	        
	        
	        
	        if($model->save())
	        {
	            $this->redirect(array('/projeto/docs', 'id'=>$model->cod_projeto));
	        }
	    }
	    $this->render('forms/_form_arquivo',array('model'=>$model, 'projeto'=>$this->loadModel($model->cod_projeto)));
	}
	
	/**
	 * Deleta um arquivo de um projeto
	 * @param integer $id - identificador do ProjetoArquivo
	 */
	public function actionDeleteFile($id){
		
		if(Yii::app()->request->isPostRequest)
		{
			$model = ProjetoArquivo::model()->findByPk($id);
			$projeto = $model->cod_projeto;
			
			
			$dir = Yii::getPathOfAlias('application.data.projetos');
			unlink($dir .DIRECTORY_SEPARATOR .$model->filename);
			$model->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/projeto/docs', 'id'=>$projeto));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
		
	}
	
		
	/**
	 * @param $id - projeto vinculado
	 */
	public function actionGastosRubricaJson($id){
		$model = new Projeto();
		$model = $model->findByPk($id);
		if($model == null) throw new CHttpException(404);
		
	}

	private function saveRubrica($rubrica, $despesa, $receita){
		
		if($rubrica->cod_rubrica == $despesa->cod_rubrica){
			$despesa->cod_verba = $receita->cod_verba;
			$despesa->save();
			echo "<br>SALVANDO A DESPESA " . $despesa->cod_despesa . " no pote " .$receita->cod_verba .'<BR>';
			
		}elseif($rubrica->cod_rubrica_pai == $despesa->cod_rubrica){
			
			$despesa->cod_verba = $receita->cod_verba;
			$despesa->save();
			echo "<br>SALVANDO A DESPESA " . $despesa->cod_despesa . " no pote " .$receita->cod_verba .'<BR>';
			
			
		}else{
			foreach($rubrica->filhas as $r)
				$this->saveRubrica($r, $despesa, $receita); //Chama recursivamente as outras rubricas
		}
	}
	
	/**
	 * Renderiza o json para o calendario
	 */
	public function actionCalendar(){
	
		if(!isset($_GET['start']) || !isset($_GET['end'])){
			$start = date('Y-m-d');
			$end = date('Y-m-d');
		}
		else{
			$start = $_GET['start'];
			$end = $_GET['end'];
		}
	
		$command =  Yii::app()->db->createCommand()
		->select('nome, data_inicio, data_fim, cod_projeto')
		->from('projeto');
		
		//Limitar data_inicio
		$results = $command->queryAll();
	
		$map_inicio = function($atv){
			$result = array(
					'id'=> "" .$atv['cod_projeto']
					,'title'=>"Início do projeto: " .$atv['nome']
					,'url'=>"" .$this->createUrl('/projeto/view', array('id'=>$atv['cod_projeto']))
					,'class'=>'event-info'
					,'start'=>""  .strtotime($atv['data_inicio']) * 1000
					,'end'=>"" .strtotime($atv['data_inicio'])*1000 + 3600 // 1 hora depois
	
			);
				
			return $result;
		};
		
		$map_termino = function($atv){
			$result = array(
					'id'=> "" .$atv['cod_projeto']
					,'title'=>"Término do projeto: " .$atv['nome']
					,'url'=>"" .$this->createUrl('/projeto/view', array('id'=>$atv['cod_projeto']))
					,'class'=>'event-success'
					,'start'=>"".strtotime($atv['data_fim'])*1000
					,'end'=>"".strtotime($atv['data_fim'])*1000 + 3600
		
			);
		
			return $result;
		};
	
	
	
		$calendarData = array(
				'success'=>1,
				'result'=>array_merge(array_map($map_inicio, $results),array_map($map_termino, $results))
		);
	
		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($calendarData);
		Yii::app()->end();
	
	}
	
	
	public function actionJson(){
		

			$where = array();
			$command =  Yii::app()->db->createCommand();
			
			$select = array(
					'cod_projeto as id'
					,	'nome'
					,	'data_inicio'
					,	'data_fim'
			);
			
			if(isset($_GET['q'])){
				$where[] = " nome ILIKE '%" .$_GET['q'] ."%' ";
			}
			
			//MONTA O SQL
			$command->from('projeto');
			$command->where = implode(' ', $where);
			$command->select = implode(', ', $select);
			$command->order = 'nome ASC';
			$command->limit(10);
			
			$results = $command->queryAll();
			
			$map = function($projeto){
				$result = array(
						'id'=> "" .$projeto['id']
						,'value'=>$projeto['nome']
						,'tokens'=>explode(" ", $projeto['nome'])
						,'url'=>"" .Yii::app()->createUrl('/projeto/view', array('id'=>$projeto['id']))
				);
				return $result;
			};
			
			$projetos = array_map($map, $results);
			echo json_encode($projetos);
			Yii::app()->end();
			
	}
	
	
	
	/**
	 * Renderiza a página de informaçoes financeiras de um projeto
	 * @param integer $id
	 */
	public function actionFinanceiro($id){
		$model = $this->loadModel($id);
		$this->render('new_view', array(
				'model'=>$model
				,	'partialView'=>'_view_financeiro_new'
				,	'activeTab'=>'tab-financeiro'
		
		));
	}

	/**
	* Renderiza parcialmente as despesas de um projeto	
	*/
	public function actionAjaxDespesas($projeto, $rubrica){

		$criteria = new CDbCriteria();		
		$criteria->compare('cod_rubrica', $rubrica);
		$criteria->compare('cod_projeto', $projeto);

		$despesas = ProjetoDespesa::model()->findAll($criteria);

		$proj = Projeto::model()->findByPk($projeto);

		if ($proj == null || $rubrica == null) throw new ChttpException(404);

		$this->layout = false;		
		$this->render('/projeto/financeiro/_despesas', array('despesas'=>$despesas, 'projeto'=>$proj));

	}
	
	
	/**
	 * Renderia a página de informações de um projeto
	 * @param integer $id
	 */
	public function actionInfo($id){
		
		$model = $this->loadModel($id);
		$this->render('new_view', array(
					'model'=>$model
				,	'partialView'=>'_view_info'
				,	'activeTab'=>'tab-info'
				
		));
	}
	
	
	/**
	 * Renderia a pagina de atividades de um projeto
	 * @param integer $id
	 */
	public function actionAtividades($id){
		
		$model = $this->loadModel($id);
		$this->render('new_view', array(
				'model'=>$model
				,	'partialView'=>'_view_atividades'
				,	'activeTab'=>'tab-atividades'
		
		));
		
	}
	
	/**
	 * Renderiza a página de documentos de um projeto
	 * @param unknown $id
	 */
	public function actionDocs($id){
		
		$model = $this->loadModel($id);
		$this->render('new_view', array(
				'model'=>$model
				,	'partialView'=>'_view_documentos'
				,	'activeTab'=>'tab-docs'
		
		));
		
	}
	
	/**
	 * Renderiza a página de gerencia de projetos
	 * @param integer $id
	 */
	public function actionGerencial($id){
		/*
		$permissao = new PermissaoProjeto();
		$permissao->cod_projeto = $id;
		
		if(isset($_POST['PermissaoProjeto']))
		{
			$permissao->attributes=$_POST['PermissaoProjeto'];
			if($permissao->save())
				$this->redirect(array('/projeto/gerencial', 'id'=>$id));
		} */
		
		$model = $this->loadModel($id);
		$this->render('new_view', array(
					'model'=>$model
				,	'partialView'=>'_view_gerencial'
				,	'activeTab'=>'tab-gerencial'
			
		));
		
	}

	/**
	 * 
	 * @param string $file
	 */
	public function actionDownloadFile($doc){
		
		$this->layout = false;
		$model = ProjetoArquivo::model()->findByPk($doc);
		if ($model == null) throw new CHttpException(404);
		
		$url = Yii::app()->baseUrl ."/protected/data/projetos/";
		$content = file_get_contents(Yii::getPathOfAlias('application.data.projetos') .DIRECTORY_SEPARATOR .$model->filename);		
		Yii::app()->request->sendFile($model->filename, $content);
		
	}

	/*
	* 
	*/
	private function broadCast($id, $msg){

		$model = $this->loadModel($id);
		
		$sender_id = Yii::app()->user->getId();
		$sender = Pessoa::model()->findByPk($sender_id)->nome;
		
		$message = "<b>{$sender}</b> {$msg} <b>{$model->nome}</b>";
		$url = $this->createUrl('view', array('id'=>$model->cod_projeto));

		$receivers = Array();

		$receivers[$model->cod_professor] = $model->coordenador;
		$receivers[$model->cod_pos_grad] = $model->vice_coordenador;
		$receivers[$model->cod_grad] = $model->fiscal;

		foreach ($model->pessoas as $p) {
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

	public function actionSetMembro(){

		if (!Yii::app()->request->isPostRequest) throw new CHttpException(404);

		$pessoa = $_POST['membro']['cod_pessoa'];
		$projeto = $_POST['membro']['cod_projeto'];
		$ativo = $_POST['membro']['ativo'];

		$model = ProjetoPessoaAtuante::model()->findByPk(array('cod_pessoa'=>$pessoa, 'cod_projeto'=>$projeto));

		if ($model == null)	$model = new ProjetoPessoaAtuante();

		//Set Attributes
		$model->cod_pessoa = $pessoa;
		$model->cod_projeto = $projeto;
		$model->ativo = $ativo;

		$model->save();

		echo var_dump($_POST['membro']);
		echo $model->ativo;
		//echo $model->attributes;

	}

	public function actionJsonRubricas($id){

		$model = $this->loadModel($id);
		$data = array();
		$data[] = array('Rubrica', 'Orçamentado', 'Recebido', 'Gastos Comprometidos', 'Gastos Correntes', 'Saldo Disponível', 'Saldo Corrente');

		 foreach($model->receitas as $receita)
			 foreach($receita->rubricas as $rub){
			 	//$recebido = $rub->calculaReceitas($rub, $model->cod_projeto);
		 		$gasto_rubrica = $receita->gastosComprometidos($rub);
		 		$recebido = $gasto_rubrica
		 		+ min($receita->saldo_comprometido,
		 			 ($receita->projeto->getOrcamentado($rub->cod_rubrica) - $gasto_rubrica)
		 			  
		 		);
		 		$gasto_comprometido = $receita->gastosComprometidos($rub);
		 		$gasto_corrente = $receita->gastosCorrentes($rub);

		 		$data[] = array($rub->nome
			 			, $model->getOrcamentado($rub->cod_rubrica) * 1.0
			 			, $recebido * 1.0
			 			, $gasto_comprometido * 1.0
			 			, $gasto_corrente * 1.0
			 			, ($recebido - $gasto_comprometido) * 1.0
			 			, ($recebido - $gasto_corrente) * 1.0
		 			);
			 }
			
			$this->layout=false;
			header('Content-type: application/json');
			echo json_encode($data);
			Yii::app()->end();
	
	}

	public function actionMorrisData($id){

		$cmdDesp =  Yii::app()->db->createCommand();
		$cmdRec =  Yii::app()->db->createCommand();

		//Receitas
		$cmdDesp->from('projeto_despesa');
		$cmdDesp->where = 'cod_projeto = :projeto AND data_compra <= :sup';
		$cmdDesp->select = 'sum(valor * quantidade)';

		//Despesas
		$cmdRec->from('projeto_verba, projeto_desembolso');
		$cmdRec->where = implode(' ',array(
		'projeto_verba.cod_verba = projeto_desembolso.cod_verba AND',
		'projeto_verba.cod_projeto = :projeto AND',
		'projeto_desembolso.data <= :sup'
		));
		$cmdRec->select = 'sum(projeto_desembolso.valor)';
				
		$model = $this->loadModel($id);
		$inf = date('Y', strtotime($model->data_inicio));
		$sup = date('Y',  strtotime($model->data_fim));

		$result = array();

		for($year = $inf; $year <= $sup; $year++){
				
			$y1 = implode('-', array($year, 12, 31)); 

			$cmdDesp->params = array('projeto'=>$id, 'sup'=>$y1);
			$cmdRec->params = array('projeto'=>$id, 'sup'=>$y1);

			$desp = $cmdDesp->queryScalar();
			$rec = $cmdRec->queryScalar();

			$result[] = array('y'=>"{$year}"
				, 'receitas'=>($rec != null) ? $rec : 0
				, 'despesas'=>($desp != null) ? $desp: 0
			);
		}

		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($result);
		Yii::app()->end();

	}

	public function actionExcelExport(){

		$command =  Yii::app()->db->createCommand();

		$command->select = 'nome, situacao, natureza';
		$command->from('projeto');
		$command->order = 'situacao, natureza, nome';

		$projeto = new Projeto();

		//Return array
		$results = $command->queryAll();

		echo "<table border='0'>";
		foreach ($results as $item) {
				echo implode(" ", array(
					"<tr><td>",				
					$item['nome'],
					"</td><td>",
					$projeto->situacoes[$item['situacao']],
					"</td><td>",
					$item['natureza'],
					"</td></tr>"
				));
		}
		echo "</table>";	
	}
	
}
