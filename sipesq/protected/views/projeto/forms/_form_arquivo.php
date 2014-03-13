<?php
/* @var $this ProjetoArquivoController */
/* @var $model ProjetoArquivo */
/* @var $form CActiveForm */

$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$projeto->nome=>array('/projeto/view', 'id'=>$projeto->cod_projeto),
	'Documentos',
);
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-arquivo',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	'errorMessageCssClass'=>'control-group error',
)); ?>

	
	<div class="alert alert-info">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Campos com <strong>*</strong> são obrigatórios.
</div>
	
	<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
	?>
	
		
	<?php if(Sipesq::isSupport()):?>
	<div class="input">
		<?php echo $form->labelEx($model,'cod_projeto'); ?>		
		<?php echo $form->dropDownList($model, 'cod_projeto', CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome', 'situacao_text'))?>
		<?php echo $form->error($model,'cod_projeto'); ?>
	</div>
	<?php endif;?>

	<div class="input">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao'); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->fileField($model, 'file')?>
<!--		<input type="dropbox-chooser" name="file" style="visibility: hidden;"/>-->
		<?php echo $form->error($model,'file'); ?>
	</div>
	
	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->