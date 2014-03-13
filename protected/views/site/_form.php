<div class="row-fluid">
	<div class="span12">
		<h1><?php echo CHtml::encode($title);?></h1>
		<div class="form">
		
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'pagina-form',
			'enableAjaxValidation'=>false,
		));
		
		Yii::app()->clientScript->registerScriptFile("//tinymce.cachefly.net/4.0/tinymce.min.js");
		Yii::app()->clientScript->registerScript('text-areas',"
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
        						relative_urls : false,
								file_browser_callback : 'filebrowser',		
									});
			");
		
		 ?>
		
			
				<?php echo CHtml::textArea("Pagina[conteudo]", $content, array('class'=>'tinyMceEditor')); ?>
			
		
			<div class="row-buttons">
				<?php echo CHtml::button('Cancelar', array('submit' => array('/about/index'), 'class'=>'btn btn-small btn-primary')); ?>
				<?php echo CHtml::submitButton('Salvar', array('class'=>'btn btn-small btn-primary')); ?>
			</div>
		
			
		
		<?php $this->endWidget(); ?>
		
		</div><!-- form -->
	</div><!--span-->
</div><!-- row -->