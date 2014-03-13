<?php
$this->breadcrumbs=array(
	'Atividades'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Listar Atividades', 'url'=>array('index')),
	array('label'=>'Gerenciar Atividade', 'url'=>array('admin')),
);
?>

<h1>Adicionar Atividade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>