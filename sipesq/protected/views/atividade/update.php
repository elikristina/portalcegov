<?php
$this->breadcrumbs=array(
	'Atividades'=>array('index'),
	$model->nome_atividade=>array('view','id'=>$model->cod_atividade),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Atividades', 'url'=>array('index')),
	array('label'=>'Adicionar Atividade', 'url'=>array('create')),
	array('label'=>'Ver esta Atividade', 'url'=>array('view', 'id'=>$model->cod_atividade)),
	array('label'=>'Gerenciar Atividades', 'url'=>array('admin')),
);
?>

<h3>Editar Atividade</h3>
<p><strong><?php echo $model->nome_atividade; ?></strong></p>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>