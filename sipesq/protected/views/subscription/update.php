<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	$model->titulo=>array('view','id'=>$model->id),
	'Editar',
);


$this->menu=array(
	array('label'=>'Ver Todos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1> <?php echo $model->titulo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>