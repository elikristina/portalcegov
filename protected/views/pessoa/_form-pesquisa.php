<h4><?php echo CHtml::encode($title);?></h4>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pessoa-form',
	'enableAjaxValidation'=>false,
)); 

Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'advanced',
								width: '100%',
        						height: '400'
							});
	");

?>

	<div class="row">
		<?php echo CHtml::textArea('Pessoa[pesquisa]', $content, array('cols'=>40,'rows'=>80))?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::button('Cancelar', array('submit' => array('/pessoa/view', 'id'=>$_GET['id']), 'class'=>'btn btn-small btn-primary')); ?>
		<?php echo CHtml::submitButton('Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->