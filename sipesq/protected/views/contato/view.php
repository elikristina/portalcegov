<?php
$this->breadcrumbs=array(
	'Contatos'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar Contatos', 'url'=>array('index')),
	array('label'=>'Adicionar Contato', 'url'=>array('create')),
	array('label'=>'Editar Contato', 'url'=>array('update', 'id'=>$model->cod_contato)),
	array('label'=>'Deletar Contato', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_contato),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Contatos', 'url'=>array('admin')),
);
?>

<h4><?php echo $model->nome; ?></h4>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'telefone',
		'email',
		'website',
		'endereco',
		'instituicao',
		'descricao',
	),
)); ?>
