<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagina-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	  <div class="row"> 
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
		<?php echo $form->error($model,'titulo'); ?>
	 </div> 
	
	<div class="row">
		<?php echo $form->labelEx($model,'conteudo'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
		 array(
		 'htmlOptions'=>array('cols'=>40, 'rows'=>80),
		 'name'=>'Pagina[conteudo]',
		 'editorTemplate'=>'full',
		 'contentCSS'=>Yii::app()->request->baseUrl .'/css/main.css',
		 'value'=>$model->conteudo));
		  ?>
		<?php echo $form->error($model,'conteudo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->