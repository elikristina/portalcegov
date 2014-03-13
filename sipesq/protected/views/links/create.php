<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Listar Links', 'url'=>array('index')),
	array('label'=>'Adicionar Link', 'url'=>array('create')),
	array('label'=>'Gerenciar Links', 'url'=>array('admin')),
);
?>

<h1>Adicionar Links</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>