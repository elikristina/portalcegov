<?php
$this->breadcrumbs=array(
	'Grupos de Trabalho'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar GTs', 'url'=>array('index')),
	array('label'=>'Adicionar GT', 'url'=>array('create')),
	array('label'=>'Gerenciar GTs', 'url'=>array('admin')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->cod_gt)),
	array('label'=>'Adicionar Projeto', 'url'=>array('createProjeto', 'id'=>$model->cod_gt)),
	array('label'=>'Gerenciar Projetos', 'url'=>array('adminProjeto', 'id'=>$model->cod_gt)),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_gt),'confirm'=>'Tem certeza que deseja deletar este GT?')),
	
);
?>

<div class="view-gt">
	<h4><b>GT <?php echo CHtml::encode($model->nome); ?></b></h4>
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('cod_coordenador')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($model->coordenador->nome),array('/pessoa/view', 'id'=>$model->cod_coordenador) ); ?>
		<br /><br />
		<?php echo $model->apresentacao; ?>
			
	<?php if(count($model->pessoas) > 0):?>
		<h5><b>Participantes</b></h5>
			<ul class="ul-list-item">
			<?php foreach($model->pessoas as $p):?>
				<?php echo CHtml::link(CHtml::encode($p->nome), array('/pessoa/view', 'id'=>$p->cod_pessoa), array('class'=>'link'));?>
			<?php endforeach;?>
			</ul>
	<?php endif;?>
	
	<?php if(count($model->projetos) > 0):?>
		<h5><b>Projetos</b></h5>
		<ul class="ul-list-item">
			<?php foreach($model->projetos as $proj):?>
				<?php echo CHtml::link(CHtml::encode($proj->nome), array('/gt/viewProjeto', 'id'=>$proj->cod_projeto), array('class'=>'link'));?>
			<?php endforeach;?>
		</ul>
	<?php endif;?>

</div>