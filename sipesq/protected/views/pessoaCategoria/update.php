<?php
$this->breadcrumbs=array(
	'Pessoa Categorias'=>array('index'),
	$model->nome
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar Categorias', 'url'=>array('create')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('admin')),
);
?>

<h4><?php echo $model->nome; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>