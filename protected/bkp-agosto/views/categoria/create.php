<?php
$this->breadcrumbs=array(
	'Equipe'=>array('/pessoa/index'),
	'Categorias'=>array('index'),
	'Adicionar Categoria',
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'Ordenar Categorias', 'url'=>array('categoria/admin')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('categoria/admin')),
);
?>

<h1>Adicionar Categoria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>