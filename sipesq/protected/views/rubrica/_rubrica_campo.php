<?php
/* @var $this RubricaCampoController */
/* @var $model RubricaCampo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rubrica-campo-form',
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
		<?php echo $form->labelEx($model,'chave'); ?>
		<?php echo $form->textField($model,'chave', array('required'=>'required')); ?>
		<?php echo $form->error($model,'chave'); ?>
	</div>
	
	<?php echo $form->hiddenField($model,'cod_campo');?>

	<div class="input">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->dropDownList($model, 'tipo', $model->campos)?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->