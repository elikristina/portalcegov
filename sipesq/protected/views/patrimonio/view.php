<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->despesa->projeto->nome=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto),
	$model->despesa->nome=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa),
	$model->nome
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para o projeto', 'url'=>array('/projeto/view', 'id'=>$model->despesa->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar para a despesa', 'url'=>array('/projetoDespesa/view', 'id'=>$model->despesa->cod_despesa)),
	array('label'=>'<i class="icon icon-plus"></i> Adicionar Patrimônio', 'url'=>array('create', 'id'=>$model->despesa->cod_despesa)),
	array('label'=>'<i class="icon icon-pencil"></i> Editar Patrimônio', 'url'=>array('update', 'id'=>$model->cod_patrimonio)),
	array('label'=>'<i class="icon icon-trash"></i> Deletar Patrimônio', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_patrimonio),'confirm'=>'Tem certeza que deseja deletar este patrimônio?')),
	array('label'=>'<i class="icon icon-list"></i> Listar Patrimônios', 'url'=>array('index'), 'visible'=>Sipesq::isSupport()),
	array('label'=>'<i class="icon icon-list-alt"></i> Gerenciar Patrimônios', 'url'=>array('admin'), 'visible'=>Sipesq::isSupport()),
);
?>

<h2><?php echo $model->nome; ?></h2>

<b>Projeto: </b> <?php echo $model->despesa->projeto->nome?><br>
<b>Despesa: </b> <?php echo $model->despesa->nome?><br>
<b>Número do Patrimônio: </b> <?php echo $model->nro_patrimonio?><br>
<b>Valor: </b> R$<?php echo $model->valor?><br>
<b>Localização: </b> <?php echo $model->localizacao?>
<div class="view">
<p>
<b>Descrição</b><br>
<?php echo $model->descricao?>
</p>
</div>


<?php if(Sipesq::isSupport()):?>
	<div class="well well-small">
	<h4>Registros</h4>
	<b>Data de Criação: </b> <?php echo $model->data_criacao?><br>
	<b>Criado por: </b> <?php echo $model->criador?><br>
	<b>Última Edição: </b> <?php echo $model->data_edicao?><br>
	<b>Editado por: </b> <?php echo $model->editor?><br>
	<ul><?php echo $model->logs?></ul>
	</div>
<?php endif;?>
