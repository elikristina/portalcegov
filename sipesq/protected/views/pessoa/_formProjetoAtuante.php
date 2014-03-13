<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pessoa-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input">
		<?php echo $form->labelEx($model,'cod_projeto_atuante'); ?>
		<?php $projetos = Projeto::model()->findAll(array('order'=>'nome'));?>
		<?php  echo $form->dropDownList($model,'cod_projeto',array("NULL"=>"Selecione um Projeto") + CHtml::listData($projetos, 'cod_projeto', 'nome') ); ?>
		<?php echo $form->error($model,'cod_projeto'); ?>
	</div>
	
	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->