<?php
$this->breadcrumbs=array(
	'Livros'=>array('index'),
	$model->titulo=>array('view','id'=>$model->cod_livro),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Livros', 'url'=>array('index')),
	array('label'=>'Adicionar Livro', 'url'=>array('create')),
	array('label'=>'Ver Livro', 'url'=>array('view', 'id'=>$model->cod_livro)),
	array('label'=>'Gerenciar Livros', 'url'=>array('admin')),
);
?>

<h1>Editar <?php echo $model->titulo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>