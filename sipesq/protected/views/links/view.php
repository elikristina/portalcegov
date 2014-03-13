<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar Links', 'url'=>array('index')),
	array('label'=>'Adicionar Link', 'url'=>array('create')),
	array('label'=>'Editar Link', 'url'=>array('update', 'id'=>$model->cod_link)),
	array('label'=>'Deletar Link', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_link),'confirm'=>'Tem certeza que deseja deletar este ítem?')),
	array('label'=>'Gerenciar Links', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->nome; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'link',
		'descricao',
		'tags',
	),
)); ?>
