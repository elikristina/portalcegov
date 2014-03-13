<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_projeto'); ?>
		<?php echo $form->textField($model,'cod_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'codigo_projeto'); ?>
		<?php echo $form->textField($model,'codigo_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_inicio'); ?>
		<?php echo $form->textField($model,'data_inicio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_fim'); ?>
		<?php echo $form->textField($model,'data_fim'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'data_relatorio'); ?>
		<?php echo $form->textField($model,'data_relatorio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_pessoa_coordenador'); ?>
		<?php echo $form->textField($model,'cod_pessoa_coordenador'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'verba_custeio'); ?>
		<?php echo $form->textField($model,'verba_custeio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'verba_capital'); ?>
		<?php echo $form->textField($model,'verba_capital'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'verba_bolsa'); ?>
		<?php echo $form->textField($model,'verba_bolsa'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->