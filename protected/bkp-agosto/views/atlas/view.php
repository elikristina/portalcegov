<?php
$this->breadcrumbs=array(
	'Atlases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Atlas', 'url'=>array('index')),
	array('label'=>'Create Atlas', 'url'=>array('create')),
	array('label'=>'Update Atlas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Atlas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Atlas', 'url'=>array('admin')),
);
?>

<h1>View Atlas #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'titulo',
		'organizacao',
		'pais',
		'local',
		'latitude',
		'longitude',
		'data_inicio',
		'data_fim',
		'marcador',
		'descricao',
	),
)); ?>
