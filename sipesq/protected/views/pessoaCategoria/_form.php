<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pessoa-categoria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="input">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->