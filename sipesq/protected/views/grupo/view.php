<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
	'Grupos'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Grupos', 'url'=>array('index')),
	array('label'=>'Adicionar Grupo', 'url'=>array('create')),
	array('label'=>'Editar Grupo', 'url'=>array('update', 'id'=>$model->cod_grupo)),
	array('label'=>'Deletar Grupo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_grupo),'confirm'=>'Are you sure you want to delete this item?')),	
);
?>

<div class="row-fluid">
<div class="span12">
<?php $data = json_decode($model->permissao);?>
<table class="table">

<?php foreach($data as $field=>$object):?>
<tr>
<td cellspan="2"><?php echo $field?></td><td></td>
</tr>
<?php foreach($object as $key=>$val):?>
<tr>
<td cellspan="2"><?php echo $key?></td><td><?php echo $val?></td>
</tr>
<?php endforeach ?>	
<?php endforeach ?>
</table>
</div>
</div>
<div class="view"><?php echo $model->descricao; ?></div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'permissao',
		'descricao',
	),
)); ?>

