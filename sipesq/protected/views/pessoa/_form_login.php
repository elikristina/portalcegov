<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'new-login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	), 
)); ?>

	<h2>Alteração de senha do usuário</h2>
	<p><b>Login: <?php echo $model->login; ?></b></p>
	
	<div class="input">
		<?php echo $form->labelEx($model,'old_password'); ?>
		<?php echo $form->passwordField($model,'old_password'); ?>
		<?php echo $form->error($model,'old_password'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'password_confirm'); ?>
		<?php echo $form->passwordField($model,'password_confirm'); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Salvar', array('class'=>'btn btn-small')); ?>
	</div>
	<?php echo $form->errorSummary($model); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
