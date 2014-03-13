<?php
$gt = GrupoTrabalho::model()->findByPk($model->cod_gt);

$this->breadcrumbs=array(
	Yii::t('default', 'gts')=>array('/gt/index'),	
	$gt->t('nome')=>array('/gt/view', 'id'=>$gt->cod_gt),
	$model->t('nome')=>array('/projeto/view', 'id'=>$model->cod_projeto),
	Yii::t('default', 'editar'),
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Adicionar Projeto', 'url'=>array('/projeto/create', 'id'=>$model->cod_gt)),
	array('label'=>'<i class="icon-info-sign"></i> Ver Projeto', 'url'=>array('/projeto/view', 'id'=>$model->cod_projeto)),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Projetos', 'url'=>array('/gt/adminProjeto', 'id'=>$model->cod_gt)),
);
?>

<h1><?php echo $model->t('nome'); ?></h1>

<?php echo $this->renderPartial('/projeto/_form', array('model'=>$model)); ?>