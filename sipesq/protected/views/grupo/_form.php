<?php
/* @var $this GrupoController */
/* @var $model Grupo */
/* @var $form CActiveForm */
?>

<div class="form">
<?php
Yii::app()->clientScript->registerScript('multiple-select',"

	$(\"select[multiple]\").bind(\"mousedown\", function(e) {
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		});
"); ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grupo-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert',
)); ?>
	
	<?php CHtml::$errorCss = 'control-group warning';?>

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
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome',array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	<div class="row-fluid">
	<div class="span6">
		<?php echo $form->labelEx($model,'pessoas'); ?>
		<?php echo $form->listBox($model,'pessoas', CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array("multiple"=>"multiple", "size"=>"20","class"=>"input-xxlarge")  ); ?>
		<?php echo $form->error($model,'pessoas'); ?>
	</div>	
	<div class="span6">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50, 'class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	</div>
	<?php $this->renderPartial('/grupo/forms/_permissoes', array('form'=>$form, 'model'=>$model))?>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar Grupo' : 'Salvar Grupo', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->