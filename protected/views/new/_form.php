<?php
/* @var $this NewController */
/* @var $model Noticia */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile("//tinymce.cachefly.net/4.0/tinymce.min.js");
Yii::app()->clientScript->registerScript('text-areas',"
		
	$('#form-tab a:first').tab('show');
  
	$('#tab-pt').click(function (e) {
	  	e.preventDefault();
	  	$('#form-pt').tab('show');
							
	});
	
	$('#tab-en').click(function (e) {
	  	e.preventDefault();
	  	$('#form-en').tab('show');
	});

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
        						height: '300',
	});
	
");
?>

<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'noticia-form',
	'enableAjaxValidation'=>false,
	 'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

		<?php echo $form->errorSummary($model); ?>
		
		
	<ul class="nav nav-tabs" id="form-tab">
	  <li><a id="tab-pt" data-target="#form-pt" data-toggle="tab">Português</a></li>
	  <li><a id="tab-en" data-target="#form-en" data-toggle="tab">English</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active alert-success" style="padding: 10px;" id="form-pt">
			<div class="control-group">
				<?php echo $form->labelEx($model,'titulo', array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'titulo', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'titulo'); ?>
			</div>
			<div class="control-group">
				<?php echo $form->labelEx($model,'texto', array('class'=>'control-label')); ?>
				<?php echo $form->textArea($model,'texto',array('class'=>'tinyMceEditor')); ?>
				<?php echo $form->error($model,'texto'); ?>
			</div>	
		</div>
		
		<div class="tab-pane  alert-info" style="padding: 10px;" id="form-en">
			<div class="control-group">
				<?php echo $form->labelEx($model,'titulo', array('class'=>'control-label')); ?>
				<?php echo $form->textField($model,'titulo_en', array('class'=>'span12')); ?>
				<?php echo $form->error($model,'titulo_en'); ?>
			</div>
			<div class="control-group">
				<?php echo $form->labelEx($model,'texto', array('class'=>'control-label')); ?>
				<?php echo $form->textArea($model,'texto_en', array('class'=>'tinyMceEditor')); ?>
				<?php echo $form->error($model,'texto_en'); ?>
			</div>
		</div>
	</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'eh_evento', array('class'=>'control-label')); ?>
			<?php echo $form->checkBox($model,'eh_evento'); ?>
			<span class="help-block">Marque se esta notícia é um evento.</span>
			<?php echo $form->error($model,'eh_evento'); ?>
		</div>
		<div class="control-group">
			<?php echo $form->labelEx($model,'eh_cursoppa', array('class'=>'control-label')); ?>
			<?php echo $form->checkBox($model,'eh_cursoppa'); ?>
			<span class="help-block">Marque se esta notícia é do Curso PPA.</span>
			<?php echo $form->error($model,'eh_cursoppa'); ?>
		</div>

		<div class="control-group">
				<?php echo $form->labelEx($model,'imageFile'); ?>
				<?php echo $form->fileField($model,'imageFile', array('class'=>'span12')); ?><br>
				<span class="hint">Arquivos com aspecto 1:1 e menores que 400kbytes</span>
				<?php echo $form->error($model,'imageFile'); ?>
		</div>

		<?php echo CHtml::submitButton($model->isNewRecord ? 'Criar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>

<?php $this->endWidget(); ?>

</div><!-- form -->