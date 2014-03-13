<?php
/* @var $this NewController */
/* @var $model Noticia */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cod_noticia'); ?>
		<?php echo $form->textField($model,'cod_noticia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'texto'); ?>
		<?php echo $form->textArea($model,'texto',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_postagem'); ?>
		<?php echo $form->textField($model,'data_postagem'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'autor'); ?>
		<?php echo $form->textField($model,'autor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'eh_evento'); ?>
		<?php echo $form->checkBox($model,'eh_evento'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->