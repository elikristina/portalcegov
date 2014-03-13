<?php
$this->breadcrumbs=array(
	'Instituições'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'List VinculoInstitucional', 'url'=>array('index')),
	array('label'=>'Manage VinculoInstitucional', 'url'=>array('admin')),
);
?>

<h1>Adicionar Instituição</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>