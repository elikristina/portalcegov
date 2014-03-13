<div class="form">
<?php
Yii::app()->clientScript->registerScript('date-formater',"
  		
	$(document).ready(
	function(){
	$('.date').html($.datepicker.formatDate( 'dd/mm/yy', new Date($('.date').html())));
	}
	
	);				
");

Yii::app()->clientScript->registerScriptFile("//tinymce.cachefly.net/4.0/tinymce.min.js");
Yii::app()->clientScript->registerScript('tabs', "
	$(function () {
	
	$('#form-tab a:first').tab('show');
  
	$('#tab-pt').click(function (e) {
	  	e.preventDefault();
	  	$('#form-pt').tab('show');
							
	})
	
	$('#tab-en').click(function (e) {
	  	e.preventDefault();
	  	$('#form-en').tab('show');
	})    
    
    tinyMCE.init({

								selector: '.tinyMceEditor',
								theme : 'modern',
								plugins: 'link, preview, media, image, code, fullscreen, nonbreaking, table, charmap',
								menubar: 'false',
								toolbar: 'formatselect | fontsizeselect | alignleft aligncenter alignright alignjustify | removeformat | bold italic underline strikethrough subscript superscript | cut copy paste | hr charmap table | bullist numlist | outdent indent | undo redo | image media link | fullscreen preview code', 
								statusbar: false,
								image_advtab: true,
								nonbreaking_force_tab: true,
								width: '100%',
        						height: '300'
        					});
  });
  
");
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

<ul class="nav nav-tabs" id="form-tab">
  		<li><a id="tab-pt" data-target="#form-pt" data-toggle="tab">Português</a></li>
  		<li><a id="tab-en" data-target="#form-en" data-toggle="tab">English</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active alert-success" style="padding: 10px;" id="form-pt">
			<div class="row">
				<?php echo $form->labelEx($model,'nome'); ?>
				<?php echo $form->textField($model,'nome', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'nome'); ?>
			</div>
	
			<div class="row">
				<?php echo $form->labelEx($model,'subtitulo'); ?>
				<?php echo $form->textField($model,'subtitulo', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'subtitulo'); ?>
			</div>
		
			<div class="row">
				<?php echo $form->labelEx($model,'status'); ?>
				<?php echo $form->textField($model,'status', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'status'); ?>
			</div>
	
			<div class="row">
				<?php echo $form->labelEx($model,'texto'); ?>
				<?php echo $form->textArea($model ,'texto', array('class'=>'tinyMceEditor'))?>
				<?php echo $form->error($model,'texto'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'financiador'); ?>
				<?php echo $form->textField($model,'financiador', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'financiador'); ?>
			</div>
		</div>
		<div class="tab-pane alert-info" style="padding: 10px;" id="form-en">
			<div class="row">
					<?php echo $form->labelEx($model,'nome'); ?>
					<?php echo $form->textField($model,'nome_en', array('class'=>'span12')); ?>
					<?php echo $form->error($model,'nome'); ?>
				</div>
		
				<div class="row">
					<?php echo $form->labelEx($model,'subtitulo'); ?>
					<?php echo $form->textField($model,'subtitulo_en', array('class'=>'span12')); ?>
					<?php echo $form->error($model,'subtitulo'); ?>
				</div>
			
				<div class="row">
					<?php echo $form->labelEx($model,'status'); ?>
					<?php echo $form->textField($model,'status_en', array('class'=>'span12')); ?>
					<?php echo $form->error($model,'status'); ?>
				</div>
		
				<div class="row">
					<?php echo $form->labelEx($model,'texto'); ?>
					<?php echo $form->textArea($model ,'texto_en', array('class'=>'tinyMceEditor'))?>
					<?php echo $form->error($model,'texto'); ?>
				</div>
				<div class="row">
					<?php echo $form->labelEx($model,'financiador'); ?>
					<?php echo $form->textField($model,'financiador_en', array('class'=>'span12')); ?>
					<?php echo $form->error($model,'financiador'); ?>
				</div>
		</div>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Projeto[data_inicio]',
				'value'=>isset($model->data_inicio) ? date('d/m/Y', strtotime($model->data_inicio)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Projeto[data_fim]',
				'value'=>isset($model->data_fim) ? date('d/m/Y', strtotime($model->data_fim)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'tipo_ajuda'); ?>
		<?php echo $form->textField($model,'tipo_ajuda'); ?>
		<?php echo $form->error($model,'tipo_ajuda'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

<span class="date"><?php echo CHtml::encode($model->data_fim); ?></span>

</div><!-- form -->