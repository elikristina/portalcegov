<div class="form">
<?php 
Yii::app()->clientScript->registerScript('text-areas',"
		
	$('#form-tab a:first').tab('show');
  
	$('#tab-pt').click(function (e) {
	  	e.preventDefault();
	  	$('#form-pt').tab('show');
							
	});
	
	$('#tab-en').click(function (e) {
	  	e.preventDefault();
	  	$('#form-en').tab('show');
	  	
	  	tinyMCE.init({
		mode : 'textareas',
		theme : 'simple',
		width: '100%',
        height: '450',
	});
	});
	
	
	
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'publicacao-tipo-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

<div class="view">
	<ul class="nav nav-tabs" id="form-tab">
		  <li><a id="tab-pt" data-target="#form-pt" data-toggle="tab">Português</a></li>
		  <li><a id="tab-en" data-target="#form-en" data-toggle="tab">English</a></li>
	</ul>
	<div class="tab-content">
			<div class="tab-pane active" id="form-pt">
				<div class="row">
					<?php echo $form->labelEx($model,'nome'); ?>
					<?php echo $form->textField($model,'nome', array('size'=>80)); ?>
					<?php echo $form->error($model,'nome'); ?>
				</div>
			</div>
			
			<div class="tab-pane active" id="form-en">
				<div class="row">
					<?php echo $form->labelEx($model,'nome'); ?>
					<?php echo $form->textField($model,'nome_en', array('size'=>80)); ?>
					<?php echo $form->error($model,'nome'); ?>
				</div>
			</div>
	</div>
</div>
			<div class="row">
				<?php echo $form->labelEx($model,'template'); ?>
				<?php echo $form->textArea($model,'template', array('cols'=>60, 'rows'=>15)); ?>
				<?php echo $form->error($model,'template'); ?>
			</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->