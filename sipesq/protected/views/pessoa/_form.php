<?php Yii::app()->clientScript->registerScript('multiple-select',"

	$(\"select[multiple]\").bind(\"mousedown\", function(e) {
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		});

		
");


Yii::app()->clientScript->registerScript('cep',"

	$('#Pessoa_cep').change(function(){
		console.log('carregando cep');
		$.getJSON('http://cep.republicavirtual.com.br/web_cep.php'
		,	{ cep: $(this).val() , formato: 'json' }
		,	function(data){
			$('#Pessoa_cidade').val(data.cidade);
			$('#Pessoa_rua_complemento').val([data.tipo_logradouro, data.logradouro].join(' '));
			$('#Pessoa_bairro').val(data.bairro);
		
		});

	});


");

?>


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

	<ul class="nav nav-tabs" id="tab-form">
	  <li class="active"><a href="#tab-pessoal" data-toggle="tab">Dados Pessoais</a></li>
	  <li><a href="#tab-profissional" data-toggle="tab">Dados Profissionais</a></li>
	  <li><a href="#tab-financeiro" data-toggle="tab">Dados Bancários</a></li>
	  <li><a href="#tab-endereco" data-toggle="tab">Endereço</a></li>
	  <?php if(Sipesq::isAdmin()):?>
	  	<li><a href="#tab-permissoes" data-toggle="tab">Permissões</a></li>
	  <?php endif;?>	  
	</ul>

	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  Campos com <strong>*</strong> são obrigatórios.
	</div>

	<div class="tab-content">
	  <div class="tab-pane active" id="tab-pessoal">
	  	<?php $this->renderPartial('forms/_pessoal', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-profissional">
	  	<?php $this->renderPartial('forms/_profissional', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-financeiro">
	  	<?php $this->renderPartial('forms/_financeiro', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-endereco">
	  	<?php $this->renderPartial('forms/_endereco', array('endereco_res'=>$endereco_res, 'form'=>$form)); ?>
	  </div>
	  <div class="tab-pane" id="tab-permissoes">
		<?php $this->renderPartial('forms/_permissoes', array('model'=>$model, 'form'=>$form)); ?>
	  </div>
	</div>

	<hr>
	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>