<?php
$this->breadcrumbs=array(
	'Atividade Categorias'=>array('index'),
	$model->cod_categoria,
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Create AtividadeCategoria', 'url'=>array('create')),
	array('label'=>'Update AtividadeCategoria', 'url'=>array('update', 'id'=>$model->cod_categoria)),
	array('label'=>'Delete AtividadeCategoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_categoria),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AtividadeCategoria', 'url'=>array('admin')),
);
?>

<h1>View AtividadeCategoria #<?php echo $model->cod_categoria; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cod_categoria',
		'cod_categoria_pai',
		'nome',
		'texto_finalizado',
		'texto_andamento',
		'descricao_relatorio',
		'descricao_adicional',
	),
)); ?>
