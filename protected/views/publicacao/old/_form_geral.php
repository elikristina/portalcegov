<div class="form">
<?php 
Yii::app()->clientScript->registerScript('validaArquivo',"

function validaArquivo () {
		if( ($('#Publicacao_file').val() == '') || ($('#Publicacao_href').val() == '')){
			alert('Você deve especificar um arquivo ou um link externo');
			return false;
		}
		return true;
		    

}

");
?>


<?php
	$loadFormUri = $this->createUrl('/publicacao/loadForm/');
	Yii::app()->clientScript->registerScript('load-form',"
	$('#Publicacao_cod_tipo').change(
		function(){
			if($(this).val() == ''){
				$('#sub-form').html('');
			}else{
				$('#sub-form').html('teste' + $(this).val());
				$('#sub-form').load('{$loadFormUri}' + '/' + $(this).val());
				
			}
		}
	);
");
?>

<?php Yii::app()->clientScript->registerScript('multiple-select',"
	$(\"select[multiple]\").bind(\"mousedown\", function(e) {
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		});
");
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publicacao-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo', array('size'=>80)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano', array('size'=>4, 'maxlength'=>4)); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php echo $form->textField($model,'autor', array('size'=>80)); ?>
		<?php echo $form->error($model,'autor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'pessoas'); ?>
		<?php  echo $form->listBox($model,'pessoas', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array("multiple"=>"multiple", "size"=>Pessoa::model()->count())  ); ?>
		<?php echo $form->error($model,'pessoas'); ?>
	</div>
	
	<div class="row">
		<label><b>URL Externa</b></label>
		<?php echo $form->textField($model,'href', array('size'=>80)); ?>
		<?php echo $form->error($model,'href'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model,'file'); ?>
		<br><span class="hint">Arquivos com no máximo 20MB</span>
		<br><span class="hint">OBS: No caso da existência de um arquivo a URL externa será ignorada.</span>
		<?php echo $form->error($model,'file'); ?>
	</div>
	

	<div class="row">
		<?php echo $form->labelEx($model,'cod_tipo'); ?>
		<?php  echo $form->dropDownList($model,'cod_tipo',CHtml::listData(PublicacaoTipo::model()->findAll(array('order'=>'nome')), 'cod_tipo', 'nome'), array('prompt'=>"Selecione um tipo de publicação") ); ?>
		<?php echo $form->error($model,'cod_tipo'); ?>
	</div>

	
	<div id="sub-form">
		<!-- FORMULARIO ESPECIFICO PARA CADA TIPO DE PUBLICACAO -->
	</div>
	
	

<?php $this->endWidget(); ?>

</div><!-- form -->