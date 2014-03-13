<?php
/* @var $this RubricaController */
/* @var $model Rubrica */

$this->breadcrumbs=array(
	'Rubricas'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_rubrica),
	'Editar',
);

$this->menu=array(
	array('label'=>'<i class="icon-tasks"></i> Listar Rubricas', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Rubrica', 'url'=>array('create')),
);
?>

<h3><?php echo $model->nome; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>