<fieldset>
	<legend>Endereço Residencial</legend>
	<?php echo $form->hiddenField($endereco_res,'tipo', array('placeholder'=>'Residencial', 'value'=>'residencial')); ?>
	<?php echo $form->error($endereco_res,'tipo'); ?>

	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'cep', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'cep', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'cep'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'logradouro', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'logradouro', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'logradouro'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'numero', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'numero', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'numero'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'complemento', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'complemento', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'complemento'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'bairro', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'bairro', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'bairro'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'cidade', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'cidade', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'cidade'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($endereco_res,'estado', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($endereco_res,'estado', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($endereco_res,'estado'); ?>
	</div>
</fieldset>