<?php
/* @var $this FerramentaController */
/* @var $model Ferramenta */

$this->breadcrumbs=array(
	'Ferramentas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ferramenta', 'url'=>array('index')),
	array('label'=>'Manage Ferramenta', 'url'=>array('admin')),
);
?>

<h1>Create Ferramenta</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>