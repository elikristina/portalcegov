<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->verba->projeto->nome=>array('/projeto/view','p'=>'financeiro', 'id'=>$model->projeto->cod_projeto),
	$model->nome=>array('view','id'=>$model->cod_despesa),
	'Editar',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar ao Projeto', 'url'=>array('/projeto/view', 'id'=>$model->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-plus"></i> Adicionar Despesa', 'url'=>array('create', 'id'=>$model->verba->cod_verba)),
);

Yii::app()->clientScript->registerScript('loadRubrica', "
	$('.hidden').show();
");

?>

<div class="row-fluid">
<div class="span12">
<h2><?php echo $model->rubrica->nome;?></h2>
<h3><?php echo $model->nome; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>
</div>