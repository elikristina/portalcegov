<?php
$this->breadcrumbs=array(
	'Publicacao Tipos'=>array('index'),
	$model->cod_tipo,
);

$this->menu=array(
	array('label'=>'List PublicacaoTipo', 'url'=>array('index')),
	array('label'=>'Create PublicacaoTipo', 'url'=>array('create')),
	array('label'=>'Update PublicacaoTipo', 'url'=>array('update', 'id'=>$model->cod_tipo)),
	array('label'=>'Delete PublicacaoTipo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_tipo),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PublicacaoTipo', 'url'=>array('admin')),
);
?>

<h1>View PublicacaoTipo #<?php echo $model->cod_tipo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cod_tipo',
		'nome',
	),
)); ?>
