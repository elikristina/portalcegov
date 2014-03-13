<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_categoria'); ?>
		<?php echo $form->textField($model,'cod_categoria'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_categoria_pai'); ?>
		<?php echo $form->textField($model,'cod_categoria_pai'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'texto_finalizado'); ?>
		<?php echo $form->textArea($model,'texto_finalizado',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'texto_andamento'); ?>
		<?php echo $form->textArea($model,'texto_andamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao_relatorio'); ?>
		<?php echo $form->textArea($model,'descricao_relatorio',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'descricao_adicional'); ?>
		<?php echo $form->textArea($model,'descricao_adicional',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->