<h4>Cadastramento das Férias</h4>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'agenda-ferias',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'cod_pessoa'); ?>
		<?php  echo $form->dropDownList($model,'cod_pessoa',CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array('prompt'=>"Selecione uma Pessoa") ); ?>
		<?php echo $form->error($model,'cod_pessoa'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Ferias[data_inicio]',
				'value'=>$model->data_inicio,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Ferias[data_fim]',
				'value'=>$model->data_fim,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Enviar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->