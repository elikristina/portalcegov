<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'subscription-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="input">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'preco'); ?>
		<?php echo $form->textField($model,'preco'); ?>
		<?php echo $form->error($model,'preco'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'login'); ?>
		<?php echo $form->textField($model,'login'); ?>
		<?php echo $form->error($model,'login'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'senha'); ?>
		<?php echo $form->textField($model,'senha'); ?>
		<?php echo $form->error($model,'senha'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'link'); ?>
		<?php echo $form->textField($model,'link'); ?>
		<?php echo $form->error($model,'link'); ?>
	</div>
	
	<div class="input">
		<label><b>Expira em</b></label>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Pessoa[data_nascimento]',
				'value'=>isset($model->validade) ? date("Y-m-d",strtotime($model->validade)) : date("Y-m-d"),
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'validade'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->