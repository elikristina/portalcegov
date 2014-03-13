<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="input">
		<?php echo $form->label($model,'cod_livro'); ?>
		<?php echo $form->textField($model,'cod_livro'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'autor'); ?>
		<?php echo $form->textField($model,'autor'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'ano'); ?>
		<?php echo $form->textField($model,'ano',array('size'=>4,'maxlength'=>4)); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'subtitulo'); ?>
		<?php echo $form->textField($model,'subtitulo'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'editora'); ?>
		<?php echo $form->textField($model,'editora'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cidade_publicacao'); ?>
		<?php echo $form->textField($model,'cidade_publicacao'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nro_edicao'); ?>
		<?php echo $form->textField($model,'nro_edicao'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nro_patrimonio'); ?>
		<?php echo $form->textField($model,'nro_patrimonio'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'cod_projeto'); ?>
		<?php echo $form->textField($model,'cod_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'local_compra'); ?>
		<?php echo $form->textField($model,'local_compra'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'nro_nota_fiscal'); ?>
		<?php echo $form->textField($model,'nro_nota_fiscal'); ?>
	</div>

	<div class="input">
		<?php echo $form->label($model,'isbn'); ?>
		<?php echo $form->textField($model,'isbn'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->