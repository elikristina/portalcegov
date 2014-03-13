<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */
/* @var $form CActiveForm */
/* @var $info ProjetoDespesaInfo */


//Carrega máscara para formatação de moeda
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');


Yii::app()->clientScript->registerScript('currency', "
	
	//Mostra os campos que estiverem ocultos por padrão
	$('.hidden').show();

	//Coloca máscara para inputs de dinheiro
	$('.money').maskMoney(
		{
			thousands: '.'
			, decimal: ','
			, allowNegative: true
		});

	//Evento para normalizar input antes do submit
	$('#projeto-despesa-form').submit(function(){
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

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jquery.tokeninput.js');?>
<?php Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl .'/css/token/token-input-facebook.css');?>
<?php 

Yii::app()->clientScript->registerScript('tokenInput', "
	
	var url = \"/sipesq/index.php/projetoDespesa/json/\";
	
	var population = $('#pop-tokens').val().split(',');

	if($('#pop-tokens').val() == '')
		population = null;

	var prePop = Array();
	for( i in population){
		var item = {};
		item['id'] = null;
		item['name'] = population[i];
		prePop.push(item);
	}
	 
	$('#ProjetoDespesa_comprador').tokenInput(url, {	
			
			
			onFreeTaggingAdd: function(item){
			
				$('#new-tokens').val($('#new-tokens').val() + item + ',');
				return item;
			},
			
			onDelete: function(item){
				var itens = $('#new-tokens').val().split(',');
				
				console.log(itens);
				var newItens = Array();
				
				for(i in itens){
					console.log('i: ' + itens[i]);
					if(itens[i] != item.name)
						newItens.push(itens[i]);
				}
				
				 $('#new-tokens').val(newItens.join(','));
				console.log('Removido'); 
				 console.log($('#new-tokens').val());
			},
			prePopulate: prePop,
			theme: 'facebook',
			searchingText: 'Buscando',
			hintText: 'Digite um nome',
			noResultsText: 'Resultado não encontrado - Pressione \'Enter\' ou \'Tab\' para adiconá-lo',
			tokenValue: 'name',
			allowFreeTagging: true,
			tokenDelimiter: ', '
			
	});


");

function recursiveDropDown($rubrica, $selected){
	if($rubrica != null){

		if(count($rubrica->filhas) < 1){
			echo $rubrica->nome;
			echo CHtml::tag('option'
				, array('value'=>$rubrica->cod_rubrica, 'selected'=>($selected == $rubrica->cod_rubrica))
				, $rubrica->numero .' ' .$rubrica->nome
				, true);
		}

		

		foreach ($rubrica->filhas as $filha){
			recursiveDropDown($filha, $selected);
		}

		
	}
}

?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'projeto-despesa-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'errorMessageCssClass'=>'alert',
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>


<?php if(!$model->isNewRecord && $model->cod_verba == null):?>
	<?php echo $form->dropDownList($model, 'cod_verba', CHtml::listData($model->projeto->receitas, 'cod_verba', 'nome_rubricas'))?>
<?php endif;?>

<?php if($model->isNewRecord):?>
		<div class="input">
			<?php echo $form->labelEx($model,'cod_rubrica'); ?>
			<?php //echo $form->dropDownList($model, 'cod_rubrica', CHtml::listData(Rubrica::model()->with('receitas')->findAll(array('condition'=>'receitas.cod_projeto = ' .$model->cod_projeto)), 'cod_rubrica', 'nome'), array('id'=>'drop-rubricas', 'prompt'=>"Selecione uma Rubrica"));?>
			<?php //echo $form->dropDownList($model, 'cod_rubrica', CHtml::listData($verba->rubricas, 'cod_rubrica', 'nome'), array('id'=>'drop-rubricas', 'prompt'=>"Selecione uma Rubrica", 'class'=>'input-xxlarge'));?>
			<select class="input-xxlarge" prompt="Selecione uma Rubrica", 'id'=>'drop-rubricas'>	
				<?php foreach ($verba->rubricas as $rubrica) {
					recursiveDropDown($rubrica, $model->cod_rubrica);
				} ?>
			</select>
			<?php echo $form->error($model,'cod_rubrica'); ?>

			
		</div>
		
		<div id="descricao-rubrica">
		<?php if($model->cod_rubrica != null): ?>
	 		<div class="well well-small">
	 			<b><i><?php echo Rubrica::model()->findByPk($model->cod_rubrica, array('select'=>'descricao'))->descricao;?></i></b>
	 		</div>
	 		<?php endif;?>
		</div>
		
	<?php else:?>
		<?php if(count($model->infos) > 0):?>
		<div class="alert alert-info">
		<?php foreach($model->infos as $key=>$info):?>
			<div class="input">
			<?php $this->renderPartial('_form_info', array('model'=>$info, 'key'=>$key))?>
			</div>
		<?php endforeach;?>
		</div>
		<?php endif;?>
<?php endif;?>
	
<div class="main-form">	
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
	
	<div class="input ">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome', array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
	<div class="input ">
		<?php echo $form->labelEx($model,'valor'); ?>
		<div class="input-prepend input-append">
  			<span class="add-on">R$</span>
  			<?php $model->valor = Yii::app()->format->number($model->valor);?>
  			<?php echo $form->textField($model,'valor', array('class'=>'money')); ?>
  			<span class="add-on">Duração (meses)</span>
  			<?php echo $form->textField($model,'quantidade', array('class'=>'input-small')); ?>
		</div>
		<div class="alert alert-info">
	  		<button type="button" class="close" data-dismiss="alert">&times;</button>
	 	 	<i>Saldo disponível: R$ <span id="saldo-disp"><?php echo number_format($model->getSaldoRubrica(),2, ',','.' ) ?></span></i>
		</div>
		<?php echo $form->error($model,'valor'); ?>
		<?php echo $form->error($model,'quantidade'); ?>
	</div>
	
	<div class="input ">
		<?php echo $form->labelEx($model,'comprador'); ?>
		<?php echo $form->textField($model,'comprador'); ?>
		<?php echo CHtml::hiddenField('pop_tokens',$model->comprador,array('id'=>'pop-tokens'))?>
		<?php echo CHtml::hiddenField('ProjetoDespesa[new_tokens]',null,array('id'=>'new-tokens'))?>
		<br><div class="alert alert-info"><i>Você pode digitar nomes de pessoas ou contatos do SIPESQ</i></div>
		<?php echo $form->error($model,'comprador'); ?>
	</div>

	<div class="input ">
		<?php echo $form->labelEx($model,'data_compra'); ?>
		<?php echo CHtml::tag('input', array('name'=>'ProjetoDespesa[data_compra]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_compra))?>
		<?php echo $form->error($model,'data_compra'); ?>
	</div>

 	<div class="input" id="campos-adicionais">
 		<?php if($model->isNewRecord && $model->cod_rubrica != null): ?>
 		<div>
 			<?php $this->renderPartial('_form_adicional', array('model'=>Rubrica::model()->findByPk($model->cod_rubrica)));?>
 		</div>
 		<?php endif;?>
 	</div>
 	
	<div class="input ">
		<?php echo $form->labelEx($model,'documento'); ?>
		<?php if($model->documento != null && $model->documento != ''):?>
			<b><?php echo CHtml::encode($model->getAttributeLabel('documento')); ?>:</b>
			<?php echo CHtml::link(substr($model->documento, stripos($model->documento, '_') + 1) .' <i class="icon icon-download"></i>', array('downloadFile', 'file'=>$model->documento), array('class'=>'tip', 'title'=>"Baixar Arquivo")); ?>
			<br />
		<?php endif;?>
		<?php echo $form->fileField($model,'documento'); ?>
		<?php echo $form->error($model,'documento'); ?>
	</div>

	<div class="input ">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model,'descricao',array('row s'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small btn-primary')); ?>
	</div>
	
</div>
<?php $this->endWidget(); ?>

</div><!-- form -->