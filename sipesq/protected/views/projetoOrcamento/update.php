<?php
/* @var $this ProjetoOrcamentoController */
/* @var $model ProjetoOrcamento */

$this->breadcrumbs=array(
	$model->projeto->nome=>array('/projeto/view', 'id'=>$model->cod_projeto),
	'Editar Orçamento',
);

?>

<h2><?php echo $model->projeto->nome?></h2>
<h3>Adicionar Orçamento</h3>

<?php echo $model->cod_rubrica?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>