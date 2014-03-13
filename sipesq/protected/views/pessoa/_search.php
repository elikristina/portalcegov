<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cod_pessoa'); ?>
		<?php echo $form->textField($model,'cod_pessoa'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome_mae'); ?>
		<?php echo $form->textField($model,'nome_mae'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpf'); ?>
		<?php echo $form->textField($model,'cpf'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg'); ?>
		<?php echo $form->textField($model,'rg'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cartao_ufrgs'); ?>
		<?php echo $form->textField($model,'cartao_ufrgs'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_projeto_atuante'); ?>
		<?php echo $form->textField($model,'cod_projeto_atuante'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cidade'); ?>
		<?php echo $form->textField($model,'cidade'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rua_complemento'); ?>
		<?php echo $form->textField($model,'rua_complemento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bairro'); ?>
		<?php echo $form->textField($model,'bairro'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cep'); ?>
		<?php echo $form->textField($model,'cep'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'banco'); ?>
		<?php echo $form->textField($model,'banco'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'agencia'); ?>
		<?php echo $form->textField($model,'agencia'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'conta_corrente'); ?>
		<?php echo $form->textField($model,'conta_corrente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lattes'); ?>
		<?php echo $form->textField($model,'lattes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_nascimento'); ?>
		<?php echo $form->textField($model,'data_nascimento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_vinculo_institucional'); ?>
		<?php echo $form->textField($model,'cod_vinculo_institucional'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cod_banco'); ?>
		<?php echo $form->textField($model,'cod_banco'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->