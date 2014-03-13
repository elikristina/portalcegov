<?php
/* @var $this FerramentaController */
/* @var $model Ferramenta */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cod_ferramenta'); ?>
		<?php echo $form->textField($model,'cod_ferramenta'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome_completo'); ?>
		<?php echo $form->textField($model,'nome_completo'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome_abreviado'); ?>
		<?php echo $form->textField($model,'nome_abreviado'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'texto'); ?>
		<?php echo $form->textField($model,'texto'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'imagem'); ?>
		<?php echo $form->textField($model,'imagem'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->