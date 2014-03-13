<?php
/* @var $this AtividadePassoController */
/* @var $model AtividadePasso */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atividade-passo-form',
	'enableAjaxValidation'=>false,
)); ?>


	<div class="input">
		<?php echo $form->labelEx($model,'cod_pessoa'); ?>
		<?php $listDataPessoas = CHtml::listData(Pessoa::model()->with('categoria')->findAll(array('order'=>'equipe_atual DESC, t.nome')), 'cod_pessoa', 'nome', 'categoria.nome');?>
		<?php  echo $form->dropDownList($model,'cod_pessoa', $listDataPessoas, array('prompt'=>"Selecione uma Pessoa")); ?>
		<?php echo $form->error($model,'cod_pessoa'); ?>
	</div>	


	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'data_prazo'); ?>
		<?php echo CHtml::tag('input', array('name'=>'AtividadePasso[data_prazo]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_prazo))?>
		<?php echo $form->error($model,'data_prazo'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->