<?php
/* @var $this NewController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	Yii::t('default', 'noticias')=>array('index'),
	$model->t('titulo'),
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-list"></i> Listar Notícias', 'url'=>array('index')),
		array('label'=>'<i class="icon-list"></i> Listar Eventos', 'url'=>array('events')),
		array('label'=>'<i class="icon-plus"></i> Adicionar Notícia', 'url'=>array('create')),
		array('label'=>'<i class="icon-pencil"></i> Editar Notícia', 'url'=>array('update', 'id'=>$model->cod_noticia)),
		array('label'=>'<i class="icon-trash"></i> Deletar Notícia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_noticia),'confirm'=>'Are you sure you want to delete this item?')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Notícias', 'url'=>array('admin')),
	);
}
?>
<div class="row-fluid">
	<div class="span12">
		<h4><?php echo CHtml::encode($model->t('titulo')); ?></h4>
		<div class="well well-small">
			<i class="pull-right"><?php echo CHtml::encode($model->data_postagem); ?></i><br>	
			<?php echo $model->t('texto') ?>
		</div>
	</div><!-- span12 -->
</div><!-- row-fluid -->
