<?php
$this->breadcrumbs=array(
	'Instituições'=>array('index'),
	$model->cod_vinculo_institucional=>array('view','id'=>$model->cod_vinculo_institucional),
	'Editar',
);

$this->menu=array(
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Update VinculoInstitucional <?php echo $model->cod_vinculo_institucional; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>