<?php
/* @var $this ProjetoVerbaController */
/* @var $model ProjetoDesembolso */
/* @var $form CActiveForm */


//Carrega máscara para moedas
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');
Yii::app()->clientScript->registerScript('currency', "

$('.money').maskMoney({thousands:'.', decimal:','});

$('#projeto-desembolso-form').submit(function(){
	$.each($('.money'), function(i,obj){
			$(obj).val($(obj).val().replace(/\./g,'').replace(',','.'));
		}
		);
	});
	
");

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-desembolso-form',
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
		<?php $model->valor = number_format($model->valor,2,',','.')?>
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor', array('class'=>'money')); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'data'); ?>
		<?php echo CHtml::tag('input', array('name'=>'ProjetoDesembolso[data]', 'type'=>'date', 'value'=>$model->isNewRecord ? date('Y-m-d') : $model->data))?>
		<?php echo $form->error($model,'data'); ?>
	</div>


	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->