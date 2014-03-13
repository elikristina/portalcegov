<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'apresentacao'); ?>
		<?php echo $form->textArea($model,'apresentacao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_coordenador'); ?>
		<?php echo $form->textField($model,'cod_coordenador'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_gt'); ?>
		<?php echo $form->textField($model,'cod_gt'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->