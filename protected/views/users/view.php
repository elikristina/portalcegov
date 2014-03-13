<?php
$this->breadcrumbs=array(
	'Usuários'=>array('index'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Criar Usuário', 'url'=>array('create')),
	array('label'=>'Gerenciar Usuários', 'url'=>array('admin')),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->id)),
);
?>

<h1><?php echo $model->username; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'username',
	),
)); ?>
