<div class="form">
<?php 
			Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/formatter.js');
			Yii::app()->clientScript->registerScript('formata_valor',"
			
			$(document).ready( 
			 function(){
			 $('#Livro_isbn').focus();
			 c = document.getElementById('Livro_valor');
			 	formataValor(c);
			 }
			
			);
			
			");
		$livros = Livro::toArray();
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'livro-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>

	<?php echo $form->errorSummary($model); ?>
	<div id="erro"></div>
	<div class="input">
	<?php
	 $onchange = '';
	 if($model->isNewRecord)
	   $onchange = "beginSearch(this.value); return false;";
	
	?>
		<?php echo $form->labelEx($model,'isbn'); ?>
		<?php echo $form->textField($model,'isbn', array('onchange'=>$onchange, 'size'=>30)); ?>
		<?php echo $form->error($model,'isbn'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'autor'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   		 'name'=>'Livro[autor]',
    	 'source'=>$livros['autores'],
		 'value'=>$model->autor,
			'htmlOptions'=>array('size'=>80),		
		));
		?>
		<?php echo $form->error($model,'autor'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'titulo'); ?>
		<?php echo $form->textArea($model,'titulo',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'titulo'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'ano'); ?>
		<?php echo $form->textField($model,'ano',array('size'=>10,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'ano'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'volume'); ?>
		<?php echo $form->textField($model,'volume',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model,'volume'); ?>
	</div>

	

	<div class="input">
		<?php echo $form->labelEx($model,'subtitulo'); ?>
		<?php echo $form->textArea($model,'subtitulo',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'subtitulo'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'editora'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   		 'name'=>'Livro[editora]',
    	 'source'=>$livros['editoras'],
		'value'=>$model->editora,
			'htmlOptions'=>array('size'=>80),		
		));
		?>
		<?php echo $form->error($model,'editora'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'cidade_publicacao'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   		 'name'=>'Livro[cidade_publicacao]',
    	 'source'=>$livros['cidades'],
			'value'=>$model->cidade_publicacao,
			'htmlOptions'=>array('size'=>80),		
		));
		?>
		<?php echo $form->error($model,'cidade_publicacao'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'nro_edicao'); ?>
		<?php echo $form->textField($model,'nro_edicao'); ?>
		<?php echo $form->error($model,'nro_edicao'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'nro_exemplares'); ?>
		<?php echo $form->textField($model,'nro_exemplares'); ?>
		<?php echo $form->error($model,'nro_exemplares'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'nro_patrimonio'); ?>
		<?php echo $form->textField($model,'nro_patrimonio'); ?>
		<?php echo $form->error($model,'nro_patrimonio'); ?>
	</div>
	
	<div class="input">
	<?php echo $form->labelEx($model,'cod_projeto'); ?>
	<?php echo $form->dropDownList($model,'cod_projeto', CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome')); ?>
	<?php echo $form->error($model,'cod_projeto'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'valor'); ?>
		<?php echo $form->textField($model,'valor', array('onkeyup'=>'formataValor(this);')); ?>
		<?php echo $form->error($model,'valor'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'local_compra'); ?>
		<?php echo $form->textField($model,'local_compra',array('size'=>80)); ?>
		<?php echo $form->error($model,'local_compra'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'nro_nota_fiscal'); ?>
		<?php echo $form->textField($model,'nro_nota_fiscal'); ?>
		<?php echo $form->error($model,'nro_nota_fiscal'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'nro_paginas'); ?>
		<?php echo $form->textField($model,'nro_paginas'); ?>
		<?php echo $form->error($model,'nro_paginas'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'localizacao_sabi'); ?>
		<?php echo $form->textField($model,'localizacao_sabi'); ?>
		<?php echo $form->error($model,'localizacao_sabi'); ?>
	</div>
	

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-small')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->