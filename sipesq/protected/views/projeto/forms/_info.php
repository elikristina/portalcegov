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
			<legend>Informações Gerais</legend>			
				<div class="control-group">
					<?php echo $form->labelEx($model,'nome', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->textField($model,'nome', array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'nome'); ?>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'nome_curto', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->textField($model,'nome_curto', array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'nome_curto'); ?>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'finalizado', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->checkBox($model,'finalizado'); ?></div>
					<?php echo $form->error($model,'finalizado'); ?>
				</div>
			
				<div class="control-group">
					<?php echo $form->labelEx($model,'situacao', array('class'=>'control-label')); ?>
					<div class="controls"><?php  echo $form->dropDownList($model,'situacao', $model->situacoes, array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'situacao'); ?>
				</div>
				<?php if(!$model->isNewRecord):?>
				<div class="control-group">
					<?php echo $form->labelEx($model,'codigo_projeto', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->textField($model,'codigo_projeto'); ?></div>
					<?php echo $form->error($model,'codigo_projeto'); ?>
				</div>
				<?php endif;?>
				<div class="control-group">
					<?php echo $form->labelEx($model,'cod_categoria', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->dropDownList($model,'cod_categoria', CHtml::listData(ProjetoCategoria::model()->findAll(array('order'=>'nome')), 'cod_categoria', 'nome'), array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'cod_categoria'); ?>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'natureza', array('class'=>'control-label')); ?>
					<div class="controls"><?php  echo $form->dropDownList($model,'natureza', array('Individual'=>'Individual', 'Coletivo'=>'Coletivo'), array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'natureza'); ?>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'gt', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->textField($model,'gt', array('class'=>'input-xxlarge')); ?></div>
					<?php echo $form->error($model,'gt'); ?>
				</div>
				<div class="control-group">
					<?php echo $form->labelEx($model,'skydrive', array('class'=>'control-label')); ?>
					<div class="controls"><?php echo $form->textField($model,'skydrive', array('class'=>'input-xxlarge', 'type'=>'url')); ?>
					<?php echo $form->error($model,'skydrive'); ?>
				</div>
</fieldset>
<fieldset>
	<legend>Prazos</legend>
	<div class="input">
		<?php echo $form->labelEx($model,'data_inicio', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo CHtml::tag('input', array('class'=>'date-picker','name'=>'Projeto[data_inicio]', 'type'=>'date', 'value'=>$model->isNewRecord ? date('Y-m-d') : $model->data_inicio))?></div>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'data_fim', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo CHtml::tag('input', array('class'=>'date-picker', 'name'=>'Projeto[data_fim]', 'type'=>'date', 'value'=>$model->isNewRecord ? date('Y-m-d') : $model->data_fim))?></div>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'data_relatorio', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo CHtml::tag('input', array('class'=>'date-picker','name'=>'Projeto[data_relatorio]', 'type'=>'date', 'value'=>$model->isNewRecord ? date('Y-m-d') : $model->data_relatorio))?></div>
		<?php echo $form->error($model,'data_relatorio'); ?>
	</div>
</fieldset>
<fieldset>
	<legend><b>Descrição</b></legend>
	<?php echo $form->textArea($model, 'descricao', array('class'=>'control-label'))?>
	<?php echo $form->error($model,'descricao'); ?>
</fieldset>