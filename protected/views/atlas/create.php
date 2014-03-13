<?php
$this->breadcrumbs=array(
	'Atlas'=>array('index'),
	'Adicionar Item',
);

$this->menu=array(
	array('label'=>'Gerenciar Itens', 'url'=>array('admin')),
);
?>

<h1>Adicionar</h1>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>