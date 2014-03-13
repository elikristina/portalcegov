<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'livro-_form_livro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php echo $form->textField($model,'autor'); ?>
		<?php echo $form->error($model,'autor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano'); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'editora'); ?>
		<?php echo $form->textField($model,'editora'); ?>
		<?php echo $form->error($model,'editora'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isbn'); ?>
		<?php echo $form->textField($model,'isbn'); ?>
		<?php echo $form->error($model,'isbn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cod_tipo'); ?>
		<?php echo $form->textField($model,'cod_tipo'); ?>
		<?php echo $form->error($model,'cod_tipo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'href'); ?>
		<?php echo $form->textField($model,'href'); ?>
		<?php echo $form->error($model,'href'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'issn'); ?>
		<?php echo $form->textField($model,'issn'); ?>
		<?php echo $form->error($model,'issn'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->