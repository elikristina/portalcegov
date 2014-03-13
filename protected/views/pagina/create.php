<?php
$this->breadcrumbs=array(
	'Serviços'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Gerenciar Serviços', 'url'=>array('admin')),
);
?>

<h1>Adicionar Serviço</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>