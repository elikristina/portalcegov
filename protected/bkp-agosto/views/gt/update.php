<?php
$this->breadcrumbs=array(
	'Grupo Trabalhos'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_gt),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar GTs', 'url'=>array('index')),
	array('label'=>'Adicionar GT', 'url'=>array('create')),
	array('label'=>'Gerenciar GTs', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>