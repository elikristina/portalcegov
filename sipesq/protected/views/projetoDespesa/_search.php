<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_despesa'); ?>
		<?php echo $form->textField($model,'cod_despesa'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_rubrica'); ?>
		<?php echo $form->textField($model,'cod_rubrica'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'comprador'); ?>
		<?php echo $form->textField($model,'comprador'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_compra'); ?>
		<?php echo $form->textField($model,'data_compra'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_projeto'); ?>
		<?php echo $form->textField($model,'cod_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'documento'); ?>
		<?php echo $form->textField($model,'documento'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_inclusao'); ?>
		<?php echo $form->textField($model,'data_inclusao'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_criador'); ?>
		<?php echo $form->textField($model,'cod_criador'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_edicao'); ?>
		<?php echo $form->textField($model,'data_edicao'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->