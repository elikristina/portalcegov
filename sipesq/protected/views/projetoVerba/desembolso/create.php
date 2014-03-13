<?php
/* @var $this ProjetoVerbaController */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/'),
	$model->verba->projeto->nome => array('/projeto/view', 'p'=>'financeiro', 'id'=>$model->verba->projeto->cod_projeto),
	'Adicionar Desembolso',
);
?>

<h1><?php echo $model->verba->projeto->nome?></h1>
<h3>Adicionar Desembolso</h3>

<?php echo $this->renderPartial('desembolso/_form', array('model'=>$model)); ?>