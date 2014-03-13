<?php

class ProjetoOrcamentoController extends Controller
{
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
				'actions'=>array('update', 'delete'),
				'expression'=> function(){
					
							//	Se for admin já retorna permissão de acesso
							if(Sipesq::isAdmin() || Sipesq::isSupport())
								return true;
					
							$projeto = ProjetoOrcamento::model()->findByPk($_GET['id'])->cod_projeto;
							$pessoa = Yii::app()->user->getId();
							
							//Verifica se atua no projeto
							if(ProjetoPessoaAtuante::model()->count('cod_projeto = :proj AND cod_pessoa = :id', array('id'=>$pessoa, 'proj'=>$projeto)) > 0)
								return true;
								
							//verifica se é um dos coordenadores
							if(Projeto::model()->count('cod_projeto = :proj AND (cod_professor = :id OR cod_grad = :id OR cod_pos_grad = :id)', array('id'=>$pessoa, 'proj'=>$projeto)))
								return true;
								
							//verifica se alguem delegou uma permissão a este usuário
							if(PermissaoProjeto::model()->count('cod_projeto = :projeto AND cod_pessoa = :id', array('id'=>$pessoa, 'projeto'=>$projeto)))
								return true;
							
							//o usuário não é permitido
							return false;				
				},
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'expression'=> function(){
			
							//	Se for admin já retorna permissão de acesso
							if(Sipesq::isAdmin() || Sipesq::isSupport())
								return true;
					
							$projeto = $_GET['id'];
							$pessoa = Yii::app()->user->getId();
							
							//Verifica se atua no projeto
							if(ProjetoPessoaAtuante::model()->count('cod_projeto = :proj AND cod_pessoa = :id', array('id'=>$pessoa, 'proj'=>$projeto)) > 0)
								return true;
								
							//verifica se é um dos coordenadores
							if(Projeto::model()->count('cod_projeto = :proj AND (cod_professor = :id OR cod_grad = :id OR cod_pos_grad = :id)', array('id'=>$pessoa, 'proj'=>$projeto)))
								return true;
								
							//verifica se alguem delegou uma permissão a este usuário
							if(PermissaoProjeto::model()->count('cod_projeto = :projeto AND cod_pessoa = :id', array('id'=>$pessoa, 'projeto'=>$projeto)))
								return true;
							
							//o usuário não é permitido
							return false;				
				},
			),

			/**
			*==================
			* PERMISSOES DE GRUPO
			*==================
			*/

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 1);					
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('update'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('projeto.financeiro') >= 2);					
				}
			),

			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('delete'),				
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
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id - cod_projeto
	 */
	public function actionCreate($id)
	{
		$model=new ProjetoOrcamento;
		
		$projeto = $this->loadProjeto($id);
		$model->cod_projeto = $id;
		$model->projeto = $projeto; 
		
		if(isset($_POST['ProjetoOrcamento']))
		{
			$model->attributes=$_POST['ProjetoOrcamento'];
			if($model->save())
				$this->redirect(array('/projeto/financeiro','id'=>$model->cod_projeto));
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

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ProjetoOrcamento']))
		{
			$model->attributes=$_POST['ProjetoOrcamento'];
			if($model->save())
				$this->redirect(array('/projeto/financeiro','id'=>$model->cod_projeto));
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
	{	$model = $this->loadModel($id);
		$projeto = $model->cod_projeto;
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/projeto/financeiro', 'id'=>$projeto));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadProjeto($id)
	{
		$model=Projeto::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	public function loadModel($id)
	{
		$model=ProjetoOrcamento::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='projeto-orcamento-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
