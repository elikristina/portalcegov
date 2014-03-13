<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login</h1>

<p>Preencha os campos abaixo:</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<div class="input">
		<?php //echo $form->labelEx($model,'username'); ?>
		<label>Usuário</label>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="input">
		<?php //echo $form->labelEx($model,'password'); ?>
		<label>Senha</label>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="input rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<label>Continuar conectado</label>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Entrar'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
