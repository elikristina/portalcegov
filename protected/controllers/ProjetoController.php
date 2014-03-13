<?php

class ProjetoController extends Controller
{
	// Uncomment the following methods and override them if needed
	public $layout='//layouts/onecolumn';
	public $id_pagina="projetos";
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update','create', 'admin', 'delete'),
				'users'=>array('admin'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	
	
	
	public function actionIndex()
	{
		
		$dataProvider=new CActiveDataProvider('Projeto', array(
			'criteria'=>array(
				'order'=>'t.nome'
			),
		));
		
		$this->render('index', array(
			'dataProvider'=>$dataProvider
		));
	}
	
	/**
	 * Mostra um determinado projeto
	 * @param integer $id
	 */
	public function actionView($id){
		
		$this->render('/projeto/view',array(
            'model'=>Projeto::model()->findByPk($id),
        ));
	}

    
    
   /**
    * Deleta um projeto
    * @param integer $id - identidicador do projeto
    * @throws CHttpException - N�o � um POST request
    */ 
   public function actionDelete($id)
    {
    	$model=Projeto::model()->findByPk($id);
		
    	if(!in_array(Yii::app()->user->name, $model->gt->getPermited())){
			throw new CHttpException(400,'Permition Denied');
		}
    	
        if(Yii::app()->request->isPostRequest)
        {
            // we only allow deletion via POST request
            Projeto::model()->findByPk($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if(!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('/gt/adminProjeto'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }
    
	
    
    /**
     * Edita um projeto
     * @param integer $id identificador do projeto
     */
    public function actionUpdate($id)
    {
        $model=Projeto::model()->findByPk($id);
		
    	if(!in_array(Yii::app()->user->name, $model->gt->getPermited())){
			throw new CHttpException(400,'Permition Denied');
		}
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if(isset($_POST['Projeto']))
        {
        	Yii::app()->end();

        	
            $model->attributes=$_POST['Projeto'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->cod_projeto));
        }

        $this->render('/projeto/update',array(
            'model'=>$model,
        ));
    }
	
}