<?php
/* @var $this FerramentaController */
/* @var $model Ferramenta */

$this->breadcrumbs=array(
	'Ferramentas'=>array('index'),
	$model->cod_ferramenta,
);

$this->menu=array(
	array('label'=>'List Ferramenta', 'url'=>array('index')),
	array('label'=>'Create Ferramenta', 'url'=>array('create')),
	array('label'=>'Update Ferramenta', 'url'=>array('update', 'id'=>$model->cod_ferramenta)),
	array('label'=>'Delete Ferramenta', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_ferramenta),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ferramenta', 'url'=>array('admin')),
);
?>

<h1>View Ferramenta #<?php echo $model->cod_ferramenta; ?></h1>



<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cod_ferramenta',
		'nome_completo',
		'nome_abreviado',
		'texto',
		'imagem',
		array(
			'type'=>'row',
			),
	),
)); ?>
