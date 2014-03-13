<?php
/* @var $this ProjetoVerbaController */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/'),
	$model->projeto->nome => array('/projeto/view', 'p'=>'financeiro', 'id'=>$model->projeto->cod_projeto),
	'Editar Desembolso',
);
?>

<h1><?php echo $model->projeto->nome?></h1>
<h3>Editar Desembolso</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>