<h1><?php echo CHtml::encode($title);?></h1>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pagina-form',
	'enableAjaxValidation'=>false,
)); ?>

	<div class="row">
		<?php $this->widget('application.extensions.tinymce.ETinyMce',
							array(
							'htmlOptions'=>array('cols'=>40,'rows'=>80),
						    'name'=>'Pagina[conteudo]',
						    'editorTemplate'=>'full',
							//'contentCSS'=>Yii::app()->request->baseUrl .'/css/main.css',
						 	'value'=>$content,
							)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button('Cancelar', array('submit' => array('/pessoa/'), 'class'=>'button')); ?>
		<?php echo CHtml::submitButton('Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->