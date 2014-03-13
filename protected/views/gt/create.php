<?php
$this->breadcrumbs=array(
	'Grupos de Trabalhos'=>array('index'),
	'Adicionar GT',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Grupos', 'url'=>array('index')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Grupos', 'url'=>array('admin')),
);

?>

<h3>Adicionar Grupo de Trabalho</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>