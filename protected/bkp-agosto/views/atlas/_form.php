<div class="form">

<?php 
Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=true");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/atlas.js");
Yii::app()->clientScript->registerScript('google-maps', "
	//Inicializa mapa
	initialize('" .$this->createUrl('/atlas/indexJson') ."');
	//Registra listeners
	registerFormListeners();
");



?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atlas-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textField($model,'titulo', array('size'=>100)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php $this->widget('application.extensions.tinymce.ETinyMce', array('htmlOptions'=>array('cols'=>10, 'rows'=>3),'name'=>'Atlas[descricao]','editorTemplate'=>'full',  'value'=>$model->descricao, 'height'=>'350px')); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	<br>
	<div class="row">
		<?php echo $form->labelEx($model,'organizacao'); ?>
		<?php echo $form->textField($model,'organizacao', array('size'=>100)); ?>
		<?php echo $form->error($model,'organizacao'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'pais'); ?>
		<?php echo $form->textField($model,'pais', array('size'=>100)); ?>
		<?php echo $form->error($model,'pais'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'local'); ?>
		<?php echo $form->textField($model,'local', array('size'=>80)); ?>
		<?php echo CHtml::link('Buscar', '#Atlas[local]', array('id'=>'query'));?>
		<?php echo $form->error($model,'local'); ?>
	</div>
	
	<div class="view">
		<div id="map_canvas">mapa</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'latitude'); ?>
		<?php echo $form->textField($model,'latitude', array('size'=>100)); ?>
		<?php echo $form->error($model,'latitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'longitude'); ?>
		<?php echo $form->textField($model,'longitude', array('size'=>100)); ?>
		<?php echo $form->error($model,'longitude'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Atlas[data_inicio]',
				'value'=>isset($model->data_inicio) ? $model->data_inicio : date('Y-m-d'),
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Atlas[data_fim]',
				'value'=>isset($model->data_fim) ? $model->data_fim : date('Y-m-d'),
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'marcador'); ?>
		<?php echo $form->fileField($model,'imageFile'); ?>
		<br><span class="hint">Imagens com aspecto 1:1 e menores que 400kbytes</span>
		<?php echo $form->error($model,'imageFile'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->