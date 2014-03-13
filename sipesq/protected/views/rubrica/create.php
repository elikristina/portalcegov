<?php
/* @var $this RubricaController */
/* @var $model Rubrica */

$this->breadcrumbs=array(
	'Rubricas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Rubricas', 'url'=>array('index')),
	array('label'=>'Gerenciar Rubricas', 'url'=>array('admin')),
);
?>

<h1>Adicionar Rubrica</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>