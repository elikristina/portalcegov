<?php
/* @var $this ProjetoReceitaController */
/* @var $model ProjetoReceita */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-receita-_form_receita-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input">
		<?php echo $form->labelEx($model,'cod_projeto'); ?>
		<?php echo $form->textField($model,'cod_projeto'); ?>
		<?php echo $form->error($model,'cod_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'cod_criador'); ?>
		<?php echo $form->textField($model,'cod_criador'); ?>
		<?php echo $form->error($model,'cod_criador'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'anexo'); ?>
		<?php echo $form->textField($model,'anexo'); ?>
		<?php echo $form->error($model,'anexo'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'data_criacao'); ?>
		<?php echo $form->textField($model,'data_criacao'); ?>
		<?php echo $form->error($model,'data_criacao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'data_edicao'); ?>
		<?php echo $form->textField($model,'data_edicao'); ?>
		<?php echo $form->error($model,'data_edicao'); ?>
	</div>


	<div class="input buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->