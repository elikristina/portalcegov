<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */
/* @var $form CActiveForm */

//Carrega máscara para formatação de moeda
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');
Yii::app()->clientScript->registerScript('currency', "

	//Coloca máscara para inputs de dinheiro
	$('.money').maskMoney({thousands:'.', decimal:','});

	//Evento para normalizar input antes do submit
	$('#patrimonio-form').submit(function(){
		$.each($('.money'), function(i,obj){
				$(obj).val($(obj).val().replace(/\./g,'').replace(',','.'));
			}
			);
		});

");

//Carrega editor de textos
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/tiny_mce/tiny_mce.js');
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '500',
        						height: '150',
        						relative_urls : false,
        						language: 'pt'
							});
	");
?>

<h2><i><?php  echo $model->despesa->nome;?></i></h2>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'patrimonio-form',
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
		<?php echo $form->labelEx($model,'valor'); ?>
		<div class="input-prepend input-append">
  			<span class="add-on">R$</span>
  			<?php $model->valor = number_format($model->valor,2,',','.')?>
  			<?php echo $form->textField($model,'valor', array('class'=>'money')); ?>  		
		</div>
		<?php echo $form->error($model,'valor'); ?>
	</div> <br/>

	<div class="input">
		<?php echo $form->labelEx($model,'nro_patrimonio'); ?>
		<?php echo $form->textField($model,'nro_patrimonio'); ?>
		<?php echo $form->error($model,'nro_patrimonio'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'localizacao'); ?>
		<?php echo $form->textField($model,'localizacao'); ?>
		<?php echo $form->error($model,'localizacao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->