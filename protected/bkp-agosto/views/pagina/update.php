<?php
$this->breadcrumbs=array(
	$model->titulo,
	'Editar',
);
/*
$this->menu=array(
	array('label'=>'Visualizar', 'url'=>array('view', 'id'=>$model->cod_pagina)),
	array('label'=>'Configurações do Site', 'url'=>array('configuracoes/index')),
);
*/
?>

<h1><?php echo $model->titulo; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>