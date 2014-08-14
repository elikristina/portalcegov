<fieldset>
	<legend>Permissões de acesso</legend>
		<div class="control-group">
			<?php echo $form->labelEx($model,'nivel_acesso', array('class'=>'control-label'));?>
			<div class="controls"><?php  echo $form->dropDownList($model,'nivel_acesso', Sipesq::listPermitionData(), array('class'=>'input-xlarge')); ?></div>
			<?php echo $form->error($model,'nivel_acesso'); ?>
		</div>
</fieldset>