<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publicacao-tipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome', array('size'=>80)); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'template'); ?>
		<?php echo $form->textArea($model,'template', array('cols'=>60, 'rows'=>15)); ?>
		<?php echo $form->error($model,'template'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->