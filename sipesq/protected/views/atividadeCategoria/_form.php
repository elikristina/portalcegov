<?php Yii::app()->clientScript->registerScript('add_categoria_pai',"

$('#form_categoria_pai').focus(
 function(){
	$('#info').html('');
	}	

);


$('#btnAddCategoria').click(
 function(){
 
 pai = $('#form_categoria_pai').val();
 
 $.get('/sipesq/index.php/atividadeCategoria/createFather/'	,
					
				{nome: pai},function (data){
						$('#AtividadeCategoria_cod_categoria_pai').append(data);
						if(data != '')
							$('#info').html('Categoria Primária <b>' + pai + '</b> Adicionada').addClass('verde');
							$('#form_categoria_pai').val('');
					},
					\"html\"); 
  }
  
);

")?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atividade-categoria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="view">
<h4>Selecione uma Categoria Primária ou Adicione uma nova</h4>
	<div class="input">
		<label><b>Categorias primárias existentes</b></label>
		<?php  echo $form->dropDownList($model,'cod_categoria_pai', CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')), 'cod_categoria', 'nome'), array('prompt'=>'Selecione uma Categoria Primária')); ?>
		<?php echo $form->error($model,'cod_categoria_pai'); ?>
		<div id="info"></div>
	</div>

<label><b>Adiciona uma nova categoria primária</b></label>	
 <?php echo CHtml::textField('form_categoria_pai'); ?>
 <?php echo CHtml::button('Adicionar', array("id"=>"btnAddCategoria"))?>
 </div>
 
 <h3>Categoria Secundária</h3>

	<div class="input">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome'); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	
		<div class="input">
		<?php echo $form->labelEx($model,'descricao_relatorio'); ?>
		<?php echo $form->textArea($model,'descricao_relatorio',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao_relatorio'); ?>
		</div>
	<div class="input">
		<?php echo $form->labelEx($model,'texto_finalizado'); ?>
		<?php echo $form->textArea($model,'texto_finalizado',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'texto_finalizado'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'texto_andamento'); ?>
		<?php echo $form->textArea($model,'texto_andamento',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'texto_andamento'); ?>
	</div>



	<div class="input">
		<?php echo $form->labelEx($model,'descricao_adicional'); ?>
		<?php echo $form->textArea($model,'descricao_adicional',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descricao_adicional'); ?>
	</div>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->