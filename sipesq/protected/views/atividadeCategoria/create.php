<?php
$this->breadcrumbs=array(
	'Categorias de Atividades'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('admin')),
);
?>

<h3>Adicionar Categoria de Atividade</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>