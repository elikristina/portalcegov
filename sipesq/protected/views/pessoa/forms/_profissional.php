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
	<legend>Projetos em que atua</legend>
	<div class="control-group">
		<?php echo $form->labelEx($model,'projetos_atuante', array('control-label')); ?>
			<div class="checkboxlist">
				<?php echo $form->listBox($model,'projetos_atuante', CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome'), array("multiple"=>"multiple", "size"=>"10", 'class'=>'input-block-level',)  ); ?>
			</div>
		</div>
		<div class="hint">Segure a tecla <b>CTRL</b> para selecionar mais de um projeto.</div><br>
</fieldset>

<fieldset>
	<legend>Informações adicionais</legend>			
	<div class="control-group">
		<?php echo $form->labelEx($model,'instituicao', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'instituicao', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'instituicao'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'orgao_departamento', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'orgao_departamento', array('class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'orgao_departamento'); ?>
	</div>
		<div class="control-group">
		<?php echo $form->labelEx($model,'siape', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'siape', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'siape'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'cartao_ufrgs', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'cartao_ufrgs', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'cartao_ufrgs'); ?>
	</div>
		<div class="control-group">
		<?php echo $form->labelEx($model,'curso', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'curso', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'curso'); ?>
	</div>
	<div class="control-group">
		<?php echo $form->labelEx($model,'lattes', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo $form->textField($model,'lattes', array('class'=>'input-xlarge')); ?></div>
		<?php echo $form->error($model,'lattes'); ?>
	</div>	
</fieldset>	

