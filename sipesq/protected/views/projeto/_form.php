<div class="form">	

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'form-horizontal'),
)); ?>

	<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
	?>
	
	
	<?php $listDataEquipe = CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'); ?>
	
	<ul class="nav nav-tabs" id="tab-form">
	  <li class="active"><a href="#tab-info" data-toggle="tab">Informações</a></li>
	  <li><a href="#tab-juridico" data-toggle="tab">Instrumento Jurídico</a></li>
	  <li><a href="#tab-convenio" data-toggle="tab">Convênio</a></li>
	  <li><a href="#tab-equipe" data-toggle="tab">Equipe</a></li>	  
	</ul>

	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  Campos com <strong>*</strong> são obrigatórios.
	</div>
 
	<div class="tab-content">
	  <div class="tab-pane active" id="tab-info">
	  	<?php $this->renderPartial('forms/_info', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-equipe">
	  	<?php $this->renderPartial('forms/_equipe', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-juridico">
	  	<fieldset>
			<legend>Instrumento Jurídico</legend>
			<?php $this->renderPartial('forms/_form_inst_juridico', array('model'=>$model->instrumento_juridico, 'form'=>$form)); ?>
		</fieldset>
	  </div>
	  <div class="tab-pane" id="tab-convenio">
	  	<fieldset>
			<legend>Convênio</legend>
			<?php $this->renderPartial('forms/_form_convenio', array('model'=>$model->convenio, 'form'=>$form)); ?>
		</fieldset>		
	  </div>
	</div>

	<hr>
	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
