<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-form',
	'enableAjaxValidation'=>false,
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

	<div class="input">
		<?php echo $form->labelEx($model,'verba_custeio'); ?>
		<?php echo $form->textField($model,'verba_custeio'); ?>
		<?php echo $form->error($model,'verba_custeio'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'verba_capital'); ?>
		<?php echo $form->textField($model,'verba_capital'); ?>
		<?php echo $form->error($model,'verba_capital'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'verba_bolsa'); ?>
		<?php echo $form->textField($model,'verba_bolsa'); ?>
		<?php echo $form->error($model,'verba_bolsa'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-financeiro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php if(isset($model->cod_projeto)):?>
		<h4> Gasto / Verba do projeto <?php echo Projeto::model()->findByPk($model->cod_projeto)->nome?></h4>
	<?php endif;?>
	
	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
  <?php if(!isset($model->cod_projeto)):?>
	<div class="input">
		<?php echo $form->labelEx($model,'cod_projeto'); ?>
		<?php $projetos["null"] = "Selecione um projeto";?>
		<?php $projetos = $projetos + CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome')?>
		<?php  echo $form->dropDownList($model,'cod_projeto', $projetos); ?>
		<?php echo $form->error($model,'cod_projeto'); ?>
	</div>
  <?php endif;?>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php $tipos = array('1'=>'Gasto Custeio', '2'=>'Gasto Outros' ,'3'=>'Verba Outros'); ?>
		<?php  echo $form->dropDownList($model,'tipo', $tipos); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'responsavel'); ?>
		<?php echo $form->textField($model,'responsavel'); ?>
		<?php echo $form->error($model,'responsavel'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor'); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->