<?php
$this->breadcrumbs=array(
	'Equipe',
	'Erro',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Categorias', 'url'=>array('categoria/create')),
);
?>

<h1>Erro</h1>
<hr>
<p><b><?php echo CHtml::encode($model->nome)?></b> não pode ser excluído, pois é coordenador dos seguintes GTs:</p>
<p><?php foreach($model->grupos_coordenador as $gt):?>
	<?php echo CHtml::link($gt->nome, array('/gt/view', 'id'=>$gt->cod_gt))?><br>
<?php endforeach;?>
</p>
<p> Troque o coordenador do(s) GT(s) ou exclua o(s) GT(s) antes de excluir <?php echo $model->nome?></p>

