<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'new-login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	), 
)); ?>

	<h3>Alteração de senha<h3>
	<h4><i><?php echo $model->name?></i></h4>
	<p><b>Login: <?php echo $model->login; ?></b></p>
	
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
