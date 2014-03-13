<?php
/* @var $this ProjetoOrcamentoController */
/* @var $model ProjetoOrcamento */
/* @var $form CActiveForm */
//Carrega máscara para formatação de moeda
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');


Yii::app()->clientScript->registerScript('currency', "

	//Coloca máscara para inputs de dinheiro
	$('.money').maskMoney(
		{
			thousands: '.'
			, decimal: ','
			, allowNegative: true
		});

	//Evento para normalizar input antes do submit
	$('#projeto-orcamento-form').submit(function(){
		$.each($('.money'), function(i,obj){
				$(obj).val($(obj).val().replace(/\./g,'').replace(',','.'));
			}
			);
		});

");
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-orcamento-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="input-row">
		<?php echo $form->labelEx($model,'cod_rubrica'); ?>
		<?php 
		$rubricas = Rubrica::model()->findAll(array('order'=>'nome'));
		/*
		$criteria = new CDbCriteria();
		$criteria->order = 't.nome';
		$criteria->with = 'orcamentos';
		$criteria->addNotInCondition('t.cod_rubrica', $model->projeto->getRubricasComOrcamento());
		$rubricas = Rubrica::model()
					->with('orcamentos')
					->findAll($criteria);
		*/
		echo $form->dropDownList(
				$model
			,	'cod_rubrica'
			,	CHtml::listData($rubricas, 'cod_rubrica', 'nome')
			,	array('id'=>'drop-rubricas', 'prompt'=>"Selecione uma Rubrica", 'class'=>'input-xxlarge', 'value'=>$model->cod_rubrica)
		);?>
		<?php echo $form->error($model,'cod_rubrica'); ?>
	</div>

	<div class="input-row">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php $model->valor = Yii::app()->format->number($model->valor);?>
  		<?php echo $form->textField($model,'valor', array('class'=>'money')); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="input-row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->