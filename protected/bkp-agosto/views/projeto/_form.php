<div class="form">
<?php
Yii::app()->clientScript->registerScript('date-formater',"
  		
	$(document).ready(
	function(){
	$('.date').html($.datepicker.formatDate( 'dd/mm/yy', new Date($('.date').html())));
	}
	
	);				
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subtitulo'); ?>
		<?php echo $form->textField($model,'subtitulo'); ?>
		<?php echo $form->error($model,'subtitulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'texto'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array(
							'htmlOptions'=>array('cols'=>40,'rows'=>80),
						    'name'=>'Projeto[texto]',
						    'editorTemplate'=>'full',
							//'contentCSS'=>Yii::app()->request->baseUrl .'/css/main.css',
						 	'value'=>$model->texto,
							)); ?>
		<?php echo $form->error($model,'texto'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Projeto[data_inicio]',
				'value'=>isset($model->data_inicio) ? date('d/m/Y', strtotime($model->data_inicio)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Projeto[data_fim]',
				'value'=>isset($model->data_fim) ? date('d/m/Y', strtotime($model->data_fim)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'financiador'); ?>
		<?php echo $form->textField($model,'financiador'); ?>
		<?php echo $form->error($model,'financiador'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_ajuda'); ?>
		<?php echo $form->textField($model,'tipo_ajuda'); ?>
		<?php echo $form->error($model,'tipo_ajuda'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

<span class="date"><?php echo CHtml::encode($model->data_fim); ?></span>

</div><!-- form -->