<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publicacao-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

<?php if($model->hasErrors()): ?>
<div class="row-fluid">
<div class="span12">
<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
?>
</div>
</div>
<?php endif; ?>

<div class="row-fluid">
	<div class="span12">
		<?php echo $this->renderPartial('_form-pessoal', array('form'=>$form, 'endereco_res'=>$endereco_res, 'model'=>$model)); ?>
	</div>
</div>


<div class="row-fluid">
	<div class="span12">
		<?php echo $this->renderPartial('_form-profissional', array('form'=>$form, 'model'=>$model)); ?>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php echo $this->renderPartial('_form-descricao', array('form'=>$form, 'model'=>$model)); ?>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-primary')); ?>
	</div>
</div>

<br/>

<?php $this->endWidget(); ?>



