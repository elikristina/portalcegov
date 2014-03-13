<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
	$model->nome
);

$this->menu=array(
	array('label'=>'Listar Grupos', 'url'=>array('index')),
	array('label'=>'Adicionar Grupo', 'url'=>array('create')),
);
?>

<h3>Grupo: <?php echo $model->nome; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>