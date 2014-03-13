<?php
$gt = GrupoTrabalho::model()->findByPk($model->cod_gt);

$this->breadcrumbs=array(
	'Grupos de Trabalho'=>array('index'),	
	$gt->nome=>array('view', 'id'=>$gt->cod_gt),
	$model->nome=>array('viewProjeto', 'id'=>$model->cod_projeto),
	'Editar',
);

$this->menu=array(
	array('label'=>'Adicionar Projeto', 'url'=>array('createProjeto', 'id'=>$model->cod_gt)),
	array('label'=>'Ver Projeto', 'url'=>array('viewProjeto', 'id'=>$model->cod_projeto)),
	array('label'=>'Gerenciar Projetos', 'url'=>array('adminProjeto', 'id'=>$model->cod_gt)),
);
?>

<h1><?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('/projeto/_form', array('model'=>$model)); ?>