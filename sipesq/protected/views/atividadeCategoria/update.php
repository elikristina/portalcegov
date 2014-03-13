<?php
$this->breadcrumbs=array(
	'Categorias de Categorias'=>array('index'),
	$model->cod_categoria=>array('view','id'=>$model->nome),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar Nova Categoria', 'url'=>array('create')),
	array('label'=>'Deletar esta Categoria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_categoria),'confirm'=>'Tem Certeza?')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('admin')),
);
?>

<h4>Editar a Categoria <u><?php echo $model->nome; ?></u></h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>