<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->titulo,
);

$this->menu=array(
	array('label'=>'Listar Subscriptions', 'url'=>array('index')),
	array('label'=>'Adicionar Subscription', 'url'=>array('create')),
	array('label'=>'Gerenciar Subscriptions', 'url'=>array('admin')),
);


$this->menu=array(
	array('label'=>'Ver Todos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Tem certeza que deseja excluir este item?')),
);
?>

<h1><?php echo $model->titulo; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'descricao',
		'preco',
		'login',
		'senha',
		'link',
		'validade',
		'titulo',
	),
)); ?>
