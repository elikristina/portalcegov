<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */
/* @var $form CActiveForm */
/* @var $info ProjetoDespesaInfo */


?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-despesa-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert',
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<div class="main-form">	
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
	
	<?php echo $form->dropDownList($model, 'cod_verba', CHtml::listData($model->projeto->receitas, 'cod_verba', 'nome_rubricas'))?>
	
	<div class="row ">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
	Projeto<br>
	<?php echo CHtml::link($model->projeto->nome, array('/projeto/view', 'id'=>$model->projeto->cod_projeto))?>
	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>
	
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->