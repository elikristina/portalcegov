<?php
$this->breadcrumbs=array(
	'Pessoa Categorias'=>array('index'),
	$model->cod_categoria,
);

$this->menu=array(
	array('label'=>'List PessoaCategoria', 'url'=>array('index')),
	array('label'=>'Create PessoaCategoria', 'url'=>array('create')),
	array('label'=>'Update PessoaCategoria', 'url'=>array('update', 'id'=>$model->cod_categoria)),
	array('label'=>'Delete PessoaCategoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_categoria),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PessoaCategoria', 'url'=>array('admin')),
);
?>

<h1>View PessoaCategoria #<?php echo $model->cod_categoria; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
	),
)); ?>
