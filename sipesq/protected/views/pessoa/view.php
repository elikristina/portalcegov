<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('index'),
	$model->cod_pessoa,
);

$this->menu=array(
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Adicionar Projeto Atuante', 'url'=>array('addprojetoatuante', 'id'=>$model->cod_pessoa)),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->cod_pessoa)),
	array('label'=>'Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_pessoa),'confirm'=>'Tem certeza que deseja excluir este item?')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Detalhes de <?php echo $model->nome; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cod_pessoa',
		'nome',
		'nome_mae',
		'telefone',
		'cpf',
		'rg',
		'cartao_ufrgs',
		'email',
		'cidade',
		'rua_complemento',
		'bairro',
		'cep',
		'banco',
		'agencia',
		'conta_corrente',
		'lattes',
		'data_nascimento',
		'cod_vinculo_institucional',
		'cod_banco',
	),
)); ?>
