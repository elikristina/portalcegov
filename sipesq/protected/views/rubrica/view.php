<?php
/* @var $this RubricaController */
/* @var $model Rubrica */

$this->breadcrumbs=array(
	'Rubricas'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar Rubricas', 'url'=>array('index')),
	array('label'=>'Criar Rubrica', 'url'=>array('create')),
	array('label'=>'Editar Rubrica', 'url'=>array('update', 'id'=>$model->cod_rubrica)),
	array('label'=>'Deletar Rubrica', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_rubrica),'confirm'=>'Are you sure you want to delete this item?')),
);
?>


<div class="view">
<h2><?php echo $model->nome; ?> <i>(<?php echo $model->numero?>)</i></h2>
<?php echo $model->descricao ?>
</div>

<?php if(count($model->campos) > 0):?>
<h3> Campos </h3>
<?php endif;?>

<?php foreach ($model->campos as $campo):?>
<b><?php echo $campo->chave;?></b> <i>(<?php echo $campo->campos[$campo->tipo];?>)</i>
<br>
<?php endforeach;?>
