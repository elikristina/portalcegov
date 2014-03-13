<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cod_publicacao'); ?>
		<?php echo $form->textField($model,'cod_publicacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'autor'); ?>
		<?php echo $form->textField($model,'autor'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ano'); ?>
		<?php echo $form->textField($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'file'); ?>
		<?php echo $form->textField($model,'file'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_tipo'); ?>
		<?php echo $form->textField($model,'cod_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->