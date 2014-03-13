<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contato-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone'); ?>
		<?php echo $form->error($model,'telefone'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'email'); ?>
		<input type="email" name="Contato[email]" id="Contato_email" value="<?php echo CHtml::encode($model->email);?> "/>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'website'); ?>		
		<input type="url" name="Contato[website]" id="Contato_website" value="<?php echo CHtml::encode($model->website);?> " placeholder="Utilize http://"/>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'endereco'); ?>
		<?php echo $form->textField($model,'endereco'); ?>
		<?php echo $form->error($model,'endereco'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'instituicao'); ?>
		<?php echo $form->textField($model,'instituicao'); ?>
		<?php echo $form->error($model,'instituicao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->