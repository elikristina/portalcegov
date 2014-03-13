<?php
/* @var $this FerramentaController */
/* @var $model Ferramenta */

$this->breadcrumbs=array(
	'Ferramentas'=>array('index'),
	$model->cod_ferramenta=>array('view','id'=>$model->cod_ferramenta),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ferramenta', 'url'=>array('index')),
	array('label'=>'Create Ferramenta', 'url'=>array('create')),
	array('label'=>'View Ferramenta', 'url'=>array('view', 'id'=>$model->cod_ferramenta)),
	array('label'=>'Manage Ferramenta', 'url'=>array('admin')),
);
?>

<h1>Update Ferramenta <?php echo $model->cod_ferramenta; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>