<?php
$gt = GrupoTrabalho::model()->findByPk($model->cod_gt);
$this->breadcrumbs=array(
	$gt->t('nome')=>array('view', 'id'=>$gt->cod_gt),
	Yii::t('default','projetos')=>array('projetos', 'id'=>$model->cod_gt),
	Yii::t('default','adicionar'),
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Projetos', 'url'=>array('projetos', 'id'=>$model->cod_gt)),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Projetos', 'url'=>array('adminProjeto', 'id'=>$model->cod_gt)),
);
?>

<h2> Adicionar Projeto</h2>

<?php echo $this->renderPartial('/projeto/_form', array('model'=>$model)); ?>