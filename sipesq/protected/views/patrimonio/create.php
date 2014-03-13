<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->despesa->projeto->nome=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto),
	$model->despesa->nome=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa),
	'Adicionar Patrimônio',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para o projeto', 'url'=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para a despesa', 'url'=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa)),
	array('label'=>'<i class="icon icon-list"></i> Listar Patrimônios', 'url'=>array('index'), 'visible'=>Sipesq::isSupport()),
	array('label'=>'<i class="icon icon-list-alt"></i> Gerenciar Patrimônios', 'url'=>array('admin'), 'visible'=>Sipesq::isSupport()),
);
?>

<h1>Adicionar Patrimônio</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>