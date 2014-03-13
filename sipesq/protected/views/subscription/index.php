<?php
$this->breadcrumbs=array(
	'Subscriptions',
);


$this->menu=array(
	array('label'=>'Ver Todos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Subscriptions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
