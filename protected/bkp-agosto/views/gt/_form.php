<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grupo-trabalho-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
	 <div class="row">
        <?php echo $form->labelEx($model,'visible'); ?>
        <?php echo $form->checkBox($model,'visible'); ?>
        <?php echo $form->error($model,'visible'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'apresentacao'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce', array('htmlOptions'=>array('cols'=>40, 'rows'=>80),'name'=>'GrupoTrabalho[apresentacao]','editorTemplate'=>'full',  'value'=>$model->apresentacao)); ?>
		<?php echo $form->error($model,'apresentacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cod_coordenador'); ?>
		<?php  echo $form->dropDownList($model,'cod_coordenador', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Selecione um Coordenador")); ?>
		<?php echo $form->error($model,'cod_coordenador'); ?>
	</div>
	<hr>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->