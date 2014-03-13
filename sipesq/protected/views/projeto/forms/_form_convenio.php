<?php /* @var InstrumentoJuridico $model */?>

<div class="control-group">
	<?php echo $form->labelEx($model,'fundacao_apoio', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'fundacao_apoio', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'fundacao_apoio'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'titulo', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'titulo', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'titulo'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'nro_convenio', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'nro_convenio', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'nro_convenio'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'protocolo_convenio', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'protocolo_convenio', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'protocolo_convenio'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'protocolo_financeiro', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'protocolo_financeiro', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'protocolo_financeiro'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'data_assinatura', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'data_assinatura', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'data_assinatura'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'vigencia', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'vigencia', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'vigencia'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'nome_proplan', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'nome_proplan', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'nome_proplan'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'cod_projeto_faufrgs', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'cod_projeto_faufrgs', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'cod_projeto_faufrgs'); ?>
</div>

<div class="control-group">
	<?php echo $form->labelEx($model,'portal_siconv', array('class'=>'control-label')); ?>
	<div class="controls"><?php echo $form->textField($model, 'portal_siconv', array('class'=>'input-xxlarge'));?></div>
	<?php echo $form->error($model,'portal_siconv'); ?>
</div>

