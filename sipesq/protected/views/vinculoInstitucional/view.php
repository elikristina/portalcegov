<?php
$this->breadcrumbs=array(
	'Instituições'=>array('index'),
	$model->cod_vinculo_institucional,
);

$this->menu=array(
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->cod_vinculo_institucional)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_vinculo_institucional),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>View VinculoInstitucional #<?php echo $model->cod_vinculo_institucional; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cod_vinculo_institucional',
		'nome',
	),
)); ?>
