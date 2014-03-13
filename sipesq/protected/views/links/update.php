<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_link),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Links', 'url'=>array('index')),
	array('label'=>'Adicionar Link', 'url'=>array('create')),
	array('label'=>'Ver este Link', 'url'=>array('view', 'id'=>$model->cod_link)),
	array('label'=>'Gerenciar Links', 'url'=>array('admin')),
);
?>

<h1>Editar Link</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>