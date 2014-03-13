<?php

class AgendaController extends Controller
{
	public $activeMenu = "Acervo";
	
	public function actionIndex()
	{
		$model = new Horario();
		$this->render('create', array('model'=>$model));
	}
	
	/**
	 * 
	 * Deleta um horario a partir de uma requisição ajax
	 * @param integer $id
	 * @param string $dia_semana
	 * @param string $turno
	 * @throws CHttpException
	 */
	
public function actionAjaxDelete($id, $turno, $dia_semana)
	{
			Horario::model()->deleteByPk(array('cod_pessoa'=>$id, 'turno'=>$turno, 'dia_semana'=>$dia_semana));

	}
	
	/**
	 * 
	 * Adiciona um horario na agenda a partir de requisições ajax
	 * @throws CHttpException
	 */
	public function actionAjaxCreate($id, $turno, $dia_semana){

		$horario = new Horario();
		$horario->cod_pessoa = $id;
		$horario->turno = $turno;
		$horario->dia_semana = $dia_semana;
		$horario->save();
	}
	
	/**
	 * 
	 * Adiciona um horario na agenda a partir de requisições ajax
	 * @throws CHttpException
	 */
	public function actionAjaxGet($id=null){
		if($id != null)
			$horarios = Horario::model()->findAll('cod_pessoa = ' .$id);
		
			
		$response = CJSON::encode($horarios, 'cod_pessoa', 'dia_semana', 'turno');
			echo $response;
			
	
	}
	
	/**
	 * Cria um período de férias na tabela 'ferias'
	 * @param integer $id - opcional: indica a pessoa que vai tirar férias
	 */
	
	public function actionCreateFerias($id = null){
		    $model=new Ferias;
		    
		    if($id != null){
		    	$model->cod_pessoa = $id; 
		    }
		
		    if(isset($_POST['Ferias']))
		    {
		        $model->attributes=$_POST['Ferias'];
		        if($model->validate())
		        {
		            // form inputs are valid, do something here
		            if($model->save())
		            	$this->redirect(array('index'));
		            return;
		        }
		    }
		    $this->render('_ferias',array('model'=>$model));
	}
	/**
	 * 
	 * Edita um período de férias dado um id de uma pessoa, 
	 * a data de inicio e sua data de fim das férias
	 * @param integer $id - identifica a pessoa
	 * @param date $data_inicio - data de início das férias
	 * @param date $data_fim - data de término das férias
	 */	
	public function actionUpdateFerias($id, $data_inicio, $data_fim){

			
			$model = Ferias::model()->findByPk(array('cod_pessoa'=>$id, 'data_inicio'=>$data_inicio, 'data_fim'=>$data_fim));
			
		    if(isset($_POST['Ferias']))
		    {
		        $model->attributes=$_POST['Ferias'];
		        if($model->validate())
		        {
		            // form inputs are valid, do something here
		            if($model->save())
		            	$this->redirect(array('index'));
		            return;
		        }
		    }
		    $this->render('_ferias',array('model'=>$model));
	}
	

	/**
	 * Renderiza a Agenda
	 */
	
	public function actionRender(){
		$this->layout=false;
		$this->render('_agenda');
	}
	
	
	
	/**
	 * Adiciona um horario na agenda
	 * Enter description here ...
	 */
	public function actionCreate()	
	{
		$model = new Horario();
	
		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index', 'create', 'ajaxget', 'render'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','index', 'ajaxcreate','updateferias', 'createferias', 'ajaxdelete'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'expression'=>function(){
					if(Pessoa::getAccessLevel(Yii::app()->user->getId()) == Sipesq::ADMIN_PERMITION)
						return true;
					else
						return false;
				}
			),
			array('deny',  // deny all users
				'users'=>array('*'),
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
	
	
}