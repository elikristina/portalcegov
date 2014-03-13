<?php
/* @var $this RubricaController */
/* @var $model Rubrica */
/* @var $form CActiveForm */
?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/rubrica.js');?>

<?php 
//Carrega editor de textos
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/tiny_mce/tiny_mce.js');
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '100%',
        						height: '300',
        						relative_urls : false,
        						language: 'pt'
							});
	");
?>
<?php Yii::app()->clientScript->registerScript('modal', "


rubrica = new Rubrica();

$('#modalBtnCampo').click(function(){
	$('#modalCampo').modal({remote: true});
});

$('#btnAddCampo').click(function(e){
 
	if($('#rubricaCampoChave').val() != ''){
		
		rubrica.createField();
		
		//Limpa valores
		$('#rubricaCampoChave').val('');
		//esconde o formulario
		$('#modalCampo').modal('hide');
	}else{
	  alert('Preencha todos os campos');
	}

});

$('#btn-edit').click(function(e){
 
	if($('#RubricaCampo_chave').val() != ''){
		
		console.log($('#rubrica-campo-form').attr('action'));
		var data = $('#rubrica-campo-form').serializeArray();
		
		
		console.log($('#RubricaCampo_cod_campo').val());
		
		$.post($('#rubrica-campo-form').attr('action'), data, function(data){
			$($('#btn-edit').attr('data-replace')).html(data);
		});
		$('#modalCampoAntigo').modal('hide');
	}else{
	  alert('Preencha todos os campos');
	}

});

$('.icon-pencil').tooltip({title: 'Editar'});
$('.icon-trash').tooltip({title: 'Excluir'});

$('.btnEditCampo').click(function(){
	$('#form-cmp-body').load($(this).attr('href'));
	$('#btn-edit').attr('data-replace',$(this).attr('data-replace'));
});

$('.btnDeleteCampo').click(function(){
	if(confirm('Deseja deletar este campo?')){
	
		$.post($(this).attr('data-href'), {id: $(this).attr('data-cod-campo')}, function(data){
			console.log(data);
		}).error(function(){
			alert('Erro! Não foi possível deletar este campo');
		});
		
		$(this).parent().parent().remove();
	}
	
	
	/*
	$.post($('#rubrica-campo-form').attr('data-href'), {id:$(this).attr('data-cod-campo')} , function(data){
			
			console.log(data);
		}); */
	//
});

");



?>

<div class="form control-group">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rubrica-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert',
)); ?>

	<?php CHtml::$errorCss = 'control-group warning';?>

	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  Campos com <strong>*</strong> são obrigatórios.
	</div>
	
	<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
	?>

	<div class="input">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
	<div class="input">
			<?php echo $form->labelEx($model,'cod_rubrica_pai'); ?>
			<?php echo $form->dropDownList($model, 'cod_rubrica_pai', CHtml::listData(Rubrica::model()->findAll(array('order'=>'nome')), 'cod_rubrica', 'nome'), array('id'=>'drop-rubricas', 'prompt'=>"Não possui pai"));?>
			<?php echo $form->error($model,'cod_rubrica_pai'); ?>
		</div>

	<div class="input">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero'); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	
	<div class="well">
	<h3>Campos Adicionais</h3>
	<div id="campos-adicionais">
	<ul style="list-style-type: none;">
	<?php foreach($model->campos as $key=>$cmp):?>
		<li class="alert alert-info">
			<span class="cmp-info" id="cmp-<?php echo $cmp->cod_campo;?>">
				<b><?php echo $cmp->chave?></b>
				<i>(<?php echo $cmp->campos[$cmp->tipo]?>)</i>
			</span>
			<div class="pull-right">
			<a class="btnEditCampo" href="<?php echo $this->createUrl('/rubrica/updateCampo/', array('id'=>$cmp->cod_campo, 'layout'=>0))?>" data-toggle="modal" data-target="#modalCampoAntigo" data-replace="#cmp-<?php echo $cmp->cod_campo;?>"><i class="icon icon-pencil"></i></a>
			<a class="btnDeleteCampo" data-href="<?php echo $this->createUrl('/rubrica/deleteCampo/', array('layout'=>0))?>" data-cod-campo="<?php echo $cmp->cod_campo;?>"><i class="icon icon-trash"></i></a>
	 		</div>
		</li>
	<?php endforeach;?>
	</ul>
	</div>
	<?php echo CHtml::link('<i class="icon icon-plus"></i> Adicionar Campo','', array('id'=>'modalBtnCampo', 'class'=>'btn btn-small', 'style'=>'text-decoration: none'))?>
	</div>

	<div class="input control-group buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->


<div class="modal hide" id="modalCampo">
	<div class="modal-header">
		<a class="close" data-dismiss="modal"><i class="icon icon-remove"></i></a>
		<h3>Adicionar Rubrica</h3>
	</div>
	<div class=".modal-body form" id="modalBody" style="padding: 20px;">
		<form id="formCampo">
			<?php $rubricaCampo = new RubricaCampo();?>
			<?php echo CHtml::label($rubricaCampo->getAttributeLabel('chave'), 'RubricaCampo[chave]')?>
			<?php echo CHtml::textField('RubricaCampo[chave]','', array('required'=>'required', 'id'=>'rubricaCampoChave')); ?><br>
			
			<?php echo CHtml::label($rubricaCampo->getAttributeLabel('tipo'), 'RubricaCampo[tipo]')?>
			<?php echo CHtml::dropDownList('RubricaCampo[tipo]', '', $rubricaCampo->campos, array('id'=>'rubricaCampoTipo'))?>
		</form>           
	</div>
	<div class="modal-footer">
		<button href="#" class="btn" data-dismiss="modal" onclick="$('#rubricaCampoChave').val('');">Fechar</button>
		<a id="btnAddCampo" class="btn btn-primary" style="text-decoration: none">Adicionar</a>
	</div>
</div>


<div class="modal hide" id="modalCampoAntigo">
	<div class="modal-header">
		<a class="close" data-dismiss="modal"><i class="icon icon-remove"></i></a>
		<h3>Editar Rubrica</h3>
	</div>
	<div class=".modal-body" id="form-cmp-body"  style="padding: 20px;">
	
	</div>
	<div class="modal-footer">
		<button href="#" class="btn" data-dismiss="modal" onclick="$('#rubricaCampoChave').val('');">Fechar</button>
		<a id="btn-edit" class="btn btn-primary" style="text-decoration: none">Salvar</a>
	</div>
</div>