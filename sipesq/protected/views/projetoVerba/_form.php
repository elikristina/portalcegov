<?php
/* @var $this ProjetoVerbaController */
/* @var $model ProjetoVerba */
/* @var $form CActiveForm */


//Carrega máscara para moedas
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');
Yii::app()->clientScript->registerScript('currency', "

$('.money').maskMoney({thousands:'.', decimal:','});
		
$('#projeto-verba-form').submit(function(){
		
	$.each($('.money'), function(i,obj){
		$(obj).val($(obj).val().replace(/\./g,'').replace(',','.'));
	});
		
	});
	
");


//Carrega editor de textos
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/tiny_mce/tiny_mce.js');
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '500',
        						height: '150',
        						relative_urls : false,
        						language: 'pt'
							});
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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-verba-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert',
)); ?>

	
	<?php CHtml::$errorCss = 'control-group warning';?>
	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  Campos com <strong>*</strong> são obrigatórios.
	</div>
	
	<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
	?>
		
	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

		<div class="input">
			<?php echo $form->labelEx($model,'rubricas'); ?>
			<?php echo $form->listBox($model,'rubricas', CHtml::listData($rubricas, 'cod_rubrica', 'nome', 'pai.nome'), array('empty'=>"Selecione uma ou mais rubricas", "multiple"=>"multiple", "class"=>"input-xxlarge", "size"=>15,)  ); ?>
			<?php echo $form->error($model,'rubricas'); ?>
		</div>

	<div class="input">
		<?php $model->valor = number_format($model->valor,2,',','.')?>
		<?php echo $form->labelEx($model,'valor'); ?>
		<div class="input-prepend">
			<span class="add-on">R$</span>
			<?php echo $form->textField($model,'valor', array('class'=>'money input-large')); ?>
		</div>
		<?php echo $form->error($model,'valor'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'data_desembolso'); ?>
		<?php echo CHtml::tag('input', array('name'=>'ProjetoVerba[data_desembolso]', 'type'=>'date', 'value'=>$model->isNewRecord ? date('Y-m-d') : $model->data_desembolso))?>
		<?php echo $form->error($model,'data_desembolso'); ?>
	</div>


	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->