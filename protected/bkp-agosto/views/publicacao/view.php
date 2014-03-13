<?php

//Seta o título para o breadCrumb - ele terá no máximo 60 caracteres
$tituloBrd = substr($model->titulo, 0, 60);
if(count_chars($model->titulo) > 60){
	$tituloBrd .= '...';
} 

$this->breadcrumbs=array(
	Yii::t('default', 'publicacoes')=>array('index'),
	$tituloBrd, //Título de no máximo 60 caracteres
);

$this->menu=array(
	array('label'=>Yii::t('Publicacao', 'add'), 'url'=>array('create')),
	array('label'=>Yii::t('Publicacao', 'update'), 'url'=>array('update', 'id'=>$model->cod_publicacao)),
	array('label'=>Yii::t('Publicacao', 'delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_publicacao),'confirm'=>'Tem certeza que deseja excluir esta publicação?')),
	array('label'=>Yii::t('Publicacao', 'admin'), 'url'=>array('admin')),
	array('label'=>Yii::t('Publicacao', 'types'), 'url'=>array('/publicacaoTipo/index')),
);



//Coloca as tags no cabeçalho para engines de pesquisa
Yii::app()->clientScript->registerMetaTag($model->tags, 'keywords');
Yii::app()->clientScript->registerMetaTag($model->descricao, 'description');

?>
<div class="view-pub-full">
	
	<div class="view-pub-image">
		<?php echo CHtml::image($model->imageLink,$model->titulo);?>
	</div>

	<div class="view-pub-information">
		<h4><b><?php echo CHtml::encode($model->titulo); ?></b></h4>
		
		<p><?php echo $model->descricao?></p>
		<br>
		<b><?php echo CHtml::encode($model->getAttributeLabel('autor')); ?>:</b>
		<?php echo CHtml::encode($model->autor); ?>
		<br />
	
		<b><?php echo CHtml::encode($model->getAttributeLabel('ano')); ?>:</b>
		<?php echo CHtml::encode($model->ano); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('tipo')); ?>:</b>
		<?php echo CHtml::encode($model->tipo->nome); ?>
		<br />
		<?php echo $model->detalhamento; ?>
		<?php echo CHtml::link(CHtml::encode('Download'),$model->href, array('target'=>'_blank', 'class'=>'button')); ?>
		<br />
	</div>
	
	<div class="clear"></div>
</div>