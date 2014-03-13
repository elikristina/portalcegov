<?php
$this->breadcrumbs=array(
	'Contatos'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_contato),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Contatos', 'url'=>array('index')),
	array('label'=>'Adicionar Contato', 'url'=>array('create')),
	array('label'=>'Ver Contato', 'url'=>array('view', 'id'=>$model->cod_contato)),
	array('label'=>'Gerenciar Contatos', 'url'=>array('admin')),
);
?>

<h1>Editar <?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>