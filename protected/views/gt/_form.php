<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grupo-trabalho-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal'),
));
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
        						height: '200'
							});
  });
  
");

?>



	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<ul class="nav nav-tabs" id="form-tab">
  		<li><a id="tab-pt" data-target="#form-pt" data-toggle="tab">Português</a></li>
  		<li><a id="tab-en" data-target="#form-en" data-toggle="tab">English</a></li>
	</ul>
	
	<div class="tab-content">
		<div class="tab-pane active alert-success" style="padding: 10px;"  id="form-pt">
			<div class="row">
				<?php echo $form->labelEx($model,'nome'); ?>
				<?php echo $form->textField($model,'nome', array("class"=>"span12")); ?>
				<?php echo $form->error($model,'nome'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'apresentacao'); ?>
				<?php // $this->widget('application.extensions.tinymce.ETinyMce', array('htmlOptions'=>array('cols'=>40, 'rows'=>80),'name'=>'GrupoTrabalho[apresentacao]','editorTemplate'=>'full',  'value'=>$model->apresentacao)); ?>
				<?php echo $form->textArea($model, 'apresentacao', array('class'=>'tinyMceEditor'))?>
				<?php echo $form->error($model,'apresentacao'); ?>
			</div>
		</div>
		
		<div class="tab-pane  alert-info" style="padding: 10px;" id="form-en">
			<div class="row">
				<?php echo $form->labelEx($model,'nome'); ?>
				<?php echo $form->textField($model,'nome_en', array("class"=>"span12")); ?>
				<?php echo $form->error($model,'nome_en'); ?>
			</div>
			
			<div class="row">
				<?php echo $form->labelEx($model,'apresentacao'); ?>
				<?php //$this->widget('application.extensions.tinymce.ETinyMce', array('htmlOptions'=>array('cols'=>40, 'rows'=>80),'name'=>'GrupoTrabalho[apresentacao]','editorTemplate'=>'full',  'value'=>$model->apresentacao_en)); ?>
				<?php echo $form->textArea($model, 'apresentacao_en', array('class'=>'tinyMceEditor'))?>
				<?php echo $form->error($model,'apresentacao_en'); ?>
			</div>
		</div>
	</div>
	<hr>
	 <div class="control-group">
        <?php echo $form->labelEx($model,'visible', array("class"=>"control-label")); ?>
        <div class="controls"><?php echo $form->checkBox($model,'visible'); ?></div>
        <?php echo $form->error($model,'visible'); ?>
    </div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'cod_coordenador', array("class"=>"control-label")); ?>
		<div class="controls"><?php  echo $form->dropDownList($model,'cod_coordenador', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Selecione um Coordenador")); ?></div>
		<?php echo $form->error($model,'cod_coordenador'); ?>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'cod_pos_responsavel', array("class"=>"control-label")); ?>
		<div class="controls"><?php  echo $form->dropDownList($model,'cod_pos_responsavel', CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Pós-Graduando Responsável")); ?></div>
		<?php echo $form->error($model,'cod_pos_responsavel'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'media', array("class"=>"control-label")); ?>
		<div class="controls"><?php  echo $form->textField($model,'media', array("class"=>"input-xxlarge")); ?></div>
		<?php echo $form->error($model,'media'); ?>
	</div>

	<hr>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->