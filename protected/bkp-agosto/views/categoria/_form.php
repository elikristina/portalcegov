<div class="form">

<?php $url = $this->createUrl('/categoria/addPai');?>
<?php Yii::app()->clientScript->registerScript('addCatPai',"

$('#form_categoria_pai').focus(
 function(){
	$('#info').html('');
	}	

);


$('#btnAddCategoria').click(
 function(){
 
 pai = $('#form_categoria_pai').val();
 
 $.get('{$url}'	,
					
				{nome: pai},function (data){
						$('#Categoria_cod_categoria_pai').append(data);
						if(data != '')
							$('#info').html('Categoria Primária <b>' + pai + '</b> Adicionada').addClass('verde');
							$('#form_categoria_pai').val('');
					},
					\"html\"); 
  }
  
);

")?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'categoria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="view">
		<h4>Selecione uma Categoria Primária ou Adicione uma nova</h4>
			<div class="row">
				<label><b>Categorias primárias existentes</b></label>
				<?php  echo $form->dropDownList($model,'cod_categoria_pai', CHtml::listData(Categoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai is NULL')), 'cod_categoria', 'nome'), array('prompt'=>'Selecione uma Categoria Primária')); ?>
				<?php echo $form->error($model,'cod_categoria_pai'); ?>
				<div id="info"></div>
			</div>
		
		<label><b>Adiciona uma nova categoria primária</b></label>	
		 <?php echo CHtml::textField('form_categoria_pai'); ?>
		 <?php echo CHtml::button('Adicionar', array("id"=>"btnAddCategoria"))?>
	 </div>
	<div class="view">
		<div class="row">
			<?php echo $form->labelEx($model,'nome'); ?>
			<?php echo $form->textField($model,'nome'); ?>
			<?php echo $form->error($model,'nome'); ?>
		</div>
	
		<div class="row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
		</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->