<?php
$this->breadcrumbs=array(
	'Pessoa Categorias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar Categorias', 'url'=>array('create')),
);
?>

<h4>Adicionar Categoria</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>