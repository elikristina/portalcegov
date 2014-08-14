<?php
//Carrega editor de textos
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/tiny_mce/tiny_mce.js');
Yii::app()->clientScript->registerScript('text-areas',
"
		tinyMCE.init({
			mode : 'exact',
			elements: 'Projeto_descricao',
			theme : 'simple',
			width: '100%',
			height: '350',
			relative_urls : false,
			language: 'pt'
	});
		
");
?>
<fieldset>
	<legend>Informações Básicas</legend>			
	<div class="control-group">
		<?php echo $form->labelEx($model,'banco', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'banco', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'banco'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'agencia', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'agencia', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'agencia'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'conta_corrente', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'conta_corrente', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'conta_corrente'); ?>
	</div>
</fieldset>	
