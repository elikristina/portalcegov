<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Adicionar',
);


$this->menu=array(
	array('label'=>'Ver Todos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Adicionar Subscription</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>