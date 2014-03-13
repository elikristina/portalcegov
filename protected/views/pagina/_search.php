<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		
		<?php echo $form->label($model,'cod_pagina');?>
		<?php echo $form->textField($model,'cod_pagina'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conteudo'); ?>
		<?php echo $form->textArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->