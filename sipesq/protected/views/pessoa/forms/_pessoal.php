<fieldset>
	<legend>Informações Básicas</legend>			
	<div class="control-group">
		<?php echo $form->labelEx($model,'nome', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'nome', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'nome_mae', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'nome_mae', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'nome_mae'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'cpf', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'cpf', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'cpf'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'rg', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'rg', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'rg'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'orgao_expedidor', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'orgao_expedidor', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'orgao_expedidor'); ?>
	</div>
	<div class="control-group">
			<?php echo $form->labelEx($model,'data_nascimento', array('class'=>'control-label')); ?>			
			<div class="controls">
				<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
	    			'name'=>'Pessoa[data_nascimento]',
					'value'=>isset($model->data_nascimento) ? Sipesq::date($model->data_nascimento) : date("d/m/Y", strtotime("1980-01-01")),
					'language'=>'pt-BR',
				    // additional javascript options for the date picker plugin
	    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
				    'htmlOptions'=>array('class'=>'input-xlarge'),));
				?>
			</div>
			<?php echo $form->error($model,'data_nascimento'); ?>
		</div>
</fieldset>	

<fieldset>
	<legend>Contato</legend>
	<div class="control-group">
		<?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'email', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'telefone', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'telefone', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'telefone'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'celular', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'celular', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'celular'); ?>
	</div>
</fieldset>