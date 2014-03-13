<?php
$this->breadcrumbs=array(
	'Grupo Trabalhos'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_gt),
	'Editar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar GTs', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar GT', 'url'=>array('create')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar GTs', 'url'=>array('admin')),
);
?>

<h2><?php echo $model->nome; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>