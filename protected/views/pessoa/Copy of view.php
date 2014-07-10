<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->cod_pessoa)),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_pessoa),'confirm'=>'Tem certeza que deseja deletar ' .$model->nome .'?')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
);
?>

<!--<h1><?php //echo $model->nome; ?></h1>-->

<div class="view">
	<?php echo CHtml::image($model->imageLink, 'Imagem pessoal', array('height'=>100, 'width'=>100)); ?>
	<div style="float: right;">
	<h1><?php echo $model->nome;?></h1>
	<?php 
	for($i = 0; $i < count($model->categorias); $i++)
		if($i < 3)
			$categorias[] = $model->categorias[$i]->nome;
	?>
	<h4><i><?php echo implode(', ', $categorias)?></i></h4>
	</div>
	
</div>
<?php if(!Yii::app()->user->isGuest):?>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'nome',
		'lattes',
		'email',
		'nome_mae',
		'rg',
		'orgao_expedidor',
		'cpf',
		'cartao_ufrgs',
		'data_nascimento',
		'nacionalidade',
	
	),
)); ?>
<?php endif;?>
<br>
<h4 align="center">Descrição</h4>
<div class="view">
	<?php echo $model->descricao;?>
</div>

<?php if(count($model->grupos) > 0):?>
<h4 align="center">Grupos de Trabalho</h4>
<div class="view">
	<ul>
		<?php foreach($model->grupos as $grupo):?>
		<li><?php echo CHtml::link(CHtml::encode($grupo->nome), array('/gt/view', 'id'=>$grupo->cod_gt));?></li>
		<?php endforeach;?>
	</ul>
</div>
<?php endif;?>