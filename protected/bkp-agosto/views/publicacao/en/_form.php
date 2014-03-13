<div class="form">
<?php 
Yii::app()->clientScript->registerScript('validaArquivo',"

function validaArquivo () {
		if( ($('#Publicacao_file').val() == '') || ($('#Publicacao_href').val() == '')){
			alert('You must specify a file or an external link');
			return false;
		}
		return true;
}

");

?>

<?php
 Yii::app()->clientScript->registerScript('multiple-select',"
	$('select[multiple]').bind('mousedown', function(e) {
    	$(this).data('remove', !$(e.target).is(':selected'));
    	$(this).data('selected', $(this).find(':selected'));
 	 }).bind('mouseup', function(e){
    	$(this).data('selected').attr('selected', 'selected');
    	e.target.selected = $(this).data('remove');
  		});
");
 
?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publicacao-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Files with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo', array('size'=>80)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php echo $form->textField($model,'autor', array('size'=>80)); ?>
		<?php echo $form->error($model,'autor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pessoas'); ?>
		<?php  echo $form->listBox($model,'pessoas', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array("multiple"=>"multiple", "size"=>Pessoa::model()->count())  ); ?>
		<?php echo $form->error($model,'pessoas'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pessoal'); ?>
		<?php echo $form->checkBox($model,'pessoal'); ?>
		<span class="hint">Check if this publication is personal. She will only appear on the homepage of the authors.</span>
		<?php echo $form->error($model,'pessoal'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano', array('size'=>4, 'maxlength'=>4)); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tags'); ?>
		<?php echo $form->textField($model,'tags', array('size'=>80)); ?>
		<br><span class="hint">Separate tags with single space.</span>
		<?php echo $form->error($model,'tags'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cod_tipo'); ?>
		<?php echo $form->dropDownList($model, 'cod_tipo',CHtml::listData(PublicacaoTipo::model()->findAll(array('order'=>'nome')), 'cod_tipo', 'nome'), array('prompt'=>"Selecione um tipo de publicação")) ?>
		<?php echo $form->error($model,'cod_tipo'); ?>
	</div>
	
	<div class="row" id="detalhamento">
		<?php echo $form->labelEx($model,'detalhamento'); ?>
		<?php echo $form->textArea($model,'detalhamento'); ?>
		<?php echo $form->error($model,'detalhamento'); ?>
	</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'url_externa'); ?>
		<?php echo $form->textField($model,'href', array('size'=>80)); ?>
		<?php echo $form->error($model,'href'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<br><span class="hint">Files up to 20MB</span>
		<br><span class="hint">PS: In the case of the existence of an external file URL is ignored.</span>
		<?php echo $form->error($model,'file'); ?>
	</div>
	
	<hr>
	
	
	<div class="row">
	
		<?php echo $form->labelEx($model,'imageFile'); ?>
		<?php if(!$model->isNewRecord):?>
			<?php 
							Yii::import('application.extensions.image.Image');
							$image = new Image($model->imageFile);
							$image->resize(100, 100, Image::AUTO);
			?>
			<?php echo CHtml::image($model->imageLink)?><br>
		<?php endif;?>
		<?php echo $form->fileField($model,'imageFile'); ?>
		<br><span class="hint">Files with aspect ratio of 1:1 and smaller than 400 kbytes</span>
		<?php echo $form->error($model,'imageFile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::link('Cancel', $model->isNewRecord ? array('/publicacao/index') : array('/publicacao/view', 'id'=>$model->cod_publicacao), array('class'=>'button'));?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Add' : 'Save', array('id'=>'btnSubmit','class'=>'button' )); ?>
	</div>
	
	<div id="sub-form">
		<!-- FORMULARIO ESPECIFICO PARA CADA TIPO DE PUBLICACAO -->
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->