<div class="form well well-large">
<?php 
Yii::app()->clientScript->registerScriptFile("//tinymce.cachefly.net/4.0/tinymce.min.js");
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({

								selector: '.tinyMceEditor',
								theme : 'modern',
								plugins: 'link, preview, media, image, code, fullscreen, nonbreaking, table, charmap',
								menubar: 'false',
								toolbar: 'fontsizeselect | bold italic | hr table | bullist numlist outdent indent | link removeformat code', 
								statusbar: false,
								image_advtab: true,
								nonbreaking_force_tab: true,
								width: '100%',
        						height: '100'
							});
	");


Yii::app()->clientScript->registerScript('multiple-select',"

	/* $(\"select[multiple]\").bind(\"mousedown\", function(e) {
		e.preventDefault();
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
 	 	e.preventDefault();
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		}); */
  		
	$(document).ready(
	function(){
	$('#datepicker').datepicker({
					inline: true
				});
	}
	
	);				
");



?>

<div class="row-fluid">
	<div class="span2">
		<h4>Foto</h4>
	</div>
	<div class="span10">
		<?php echo $form->fileField($model,'imageFile', array('class'=>'span12')); ?><br>
		<span class="hint">Arquivos com aspecto 1:1 e menores que 400kbytes</span>
		<?php echo $form->error($model,'imageFile'); ?>
	</div>
</div>

<!-- 
<div class="row-fluid" >
	<div class="span6">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model, 'descricao', array('class'=>'tinyMceEditor'));?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	<div class="span6">		
		<?php echo $form->labelEx($model,'descricao_en'); ?>
		<?php echo $form->textArea($model, 'descricao_en', array('class'=>'tinyMceEditor'));?>
		<?php echo $form->error($model,'descricao_en'); ?>
	</div>
</div> -->
</div>