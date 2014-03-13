<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin'), 'visible'=>Sipesq::isAdmin()),
);
?>

<h1>Adicionar Pessoa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>