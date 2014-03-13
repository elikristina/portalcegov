<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_contato'); ?>
		<?php echo $form->textField($model,'cod_contato'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'website'); ?>
		<?php echo $form->textField($model,'website'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'endereco'); ?>
		<?php echo $form->textField($model,'endereco'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'instituicao'); ?>
		<?php echo $form->textField($model,'instituicao'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Buscar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->