<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->despesa->projeto->nome=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto),
	$model->despesa->nome=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa),
	$model->nome=>array('view','id'=>$model->cod_patrimonio),
	'Editar'
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para o projeto', 'url'=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para a despesa', 'url'=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa)),
	array('label'=>'<i class="icon icon-plus"></i> Adicionar Patrimônio', 'url'=>array('create', 'id'=>$model->despesa->cod_despesa)),
	array('label'=>'<i class="icon icon-search"></i> Ver Patrimônio', 'url'=>array('view', 'id'=>$model->cod_patrimonio)),
	array('label'=>'<i class="icon icon-trash"></i> Deletar Patrimônio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_patrimonio),'confirm'=>'Tem certeza que deseja deletar este patrimônio?')),
	array('label'=>'<i class="icon icon-list"></i> Listar Patrimônios', 'url'=>array('index'), 'visible'=>Sipesq::isSupport()),
	array('label'=>'<i class="icon icon-list-alt"></i> Gerenciar Patrimônios', 'url'=>array('admin'), 'visible'=>Sipesq::isSupport()),
);
?>

<h2>Patrimônio <?php echo $model->nro_patrimonio?>: <?php echo $model->nome; ?></h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>