<?php
$this->breadcrumbs=array(
	'Grupo Trabalhos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GrupoTrabalho', 'url'=>array('index')),
	array('label'=>'Manage GrupoTrabalho', 'url'=>array('admin')),
);
?>

<h1>Create GrupoTrabalho</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>