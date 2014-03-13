<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_patrimonio'); ?>
		<?php echo $form->textField($model,'cod_patrimonio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_projeto_despesa'); ?>
		<?php echo $form->textField($model,'cod_projeto_despesa'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nro_patrimonio'); ?>
		<?php echo $form->textField($model,'nro_patrimonio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'localizacao'); ?>
		<?php echo $form->textField($model,'localizacao'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->