<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'preco'); ?>
		<?php echo $form->textField($model,'preco'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'login'); ?>
		<?php echo $form->textField($model,'login'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'senha'); ?>
		<?php echo $form->textField($model,'senha'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'link'); ?>
		<?php echo $form->textField($model,'link'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'validade'); ?>
		<?php echo $form->textField($model,'validade'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->