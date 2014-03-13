<?php
$this->breadcrumbs=array(
	Yii::t('default', 'gts')=>array('index'),
	$model->t('nome'),
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-list"></i> Listar GTs', 'url'=>array('index')),
		array('label'=>'<i class="icon-plus"></i> Adicionar GT', 'url'=>array('create')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar GTs', 'url'=>array('admin')),
		array('label'=>'<i class="icon-pencil"></i> Editar GT', 'url'=>array('update', 'id'=>$model->cod_gt)),
		array('label'=>'<i class="icon-plus"></i> Adicionar Projeto', 'url'=>array('createProjeto', 'id'=>$model->cod_gt)),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Projetos', 'url'=>array('adminProjeto', 'id'=>$model->cod_gt)),
		array('label'=>'<i class="icon-trash"></i> Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_gt),'confirm'=>'Tem certeza que deseja deletar este GT?')),
	);
}
?>

<div class="row-fluid">
	<div class="span7">
		<div class="gt-video">
			<?php if (isset($model->media)):?>
			<?php echo CHtml::link($model->media);?>
		<?php else:?>
		<iframe width="480" height="360" src="//www.youtube.com/embed/MoqA7D1UrIE?showinfo=0&controls=2&rel=0&autohide=1" frameborder="0" allowfullscreen></iframe>
		<?php endif;?>
		</div>		
	</div>
	
	<div class="span5">
		<span class="gt-gt">Grupo de Trabalho</span><br />
		<span class="gt-name"><?php echo CHtml::encode($model->t('nome')); ?></span><br />
		<?php echo $model->t('apresentacao'); ?>
	</div>
</div>

<div class="row-fluid">
	<hr>
	<p>
		<b><?php echo CHtml::encode($model->getAttributeLabel('cod_coordenador')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($model->coordenador->nome), array('/pessoa/view', 'id'=>$model->coordenador->cod_pessoa)	); ?>
		<br />
		<?php if(isset($model->pos_responsavel)):?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('cod_pos_responsavel')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($model->pos_responsavel->nome), array('/pessoa/view', 'id'=>$model->pos_responsavel->cod_pessoa)	); ?>
		<br />
		<?php endif;?>
		</p>
			
	<?php if(count($model->pessoas) > 0):?>
		<h5><b><?php echo Yii::t('GrupoTrabalho', 'participantes')?></b></h5>
			<ul class="ul-list-item">
			<?php foreach($model->pessoas as $p):?>
				<?php //echo CHtml::link(CHtml::encode($p->nome), array('/pessoa/view', 'id'=>$p->cod_pessoa), array('class'=>'link'));?>
				<?php $this->renderPartial('/pessoa/_pessoa-min', array('data'=>$p))?>
			<?php endforeach;?>
			</ul>
	<?php endif;?>
	
	<?php if(count($model->projetos) > 0):?>
		<hr>
		<h5><b><?php echo Yii::t('default', 'projetos')?></b></h5>
			<?php foreach($model->projetos as $proj):?>
				<?php echo CHtml::link(CHtml::encode($proj->t('nome')), array('/gt/viewProjeto', 'id'=>$proj->cod_projeto));?><br>
			<?php endforeach;?>
	<?php endif;?>

</div><!-- row -->