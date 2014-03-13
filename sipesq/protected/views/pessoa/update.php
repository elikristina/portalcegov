<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_pessoa),
	'Editar',
);

$this->menu=array(
	array('label'=>'Adicionar uma Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
	
);
?>

<h1><?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>