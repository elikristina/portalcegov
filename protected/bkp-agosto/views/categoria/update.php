<?php
$this->breadcrumbs=array(
	'Categorias'=>array('index'),
	$model->nome
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'Ordenar Categorias', 'url'=>array('categoria/admin')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('categoria/admin')),
);
?>

<h4><?php echo $model->nome; ?></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>