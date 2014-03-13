<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesaInfo*/
?>
	
	<?php echo CHtml::hiddenField('ProjetoDespesaInfo[' .$key .'][chave]', $model->chave)?>
	<?php echo CHtml::hiddenField('ProjetoDespesaInfo[' .$key .'][cod_info]', $model->cod_info)?>
	<?php echo CHtml::hiddenField('ProjetoDespesaInfo[' .$key .'][tipo]', $model->tipo)?>
	
	<?php echo CHtml::label($model->chave, 'ProjetoDespesaInfo[' .$key .'][valor]')?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_TEXTO):?>
		<?php echo CHtml::textField('ProjetoDespesaInfo[' .$key .'][valor]', $model->valor, array('class'=>'input-xxlarge'))?>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_TEXTO_LONGO):?>
		<?php echo CHtml::textArea('ProjetoDespesaInfo[' .$key .'][valor]', $model->valor)?>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_DATA):?>
		<?php echo CHtml::tag('input', array('name'=>'ProjetoDespesaInfo[' .$key .'][valor]', 'type'=>'date', 'value'=>is_null($model->valor) ? date('Y-m-d') : Sipesq::dateRfc($model->valor)))?>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_ANEXO):?>
	
		<?php if($model->valor != ''):?>
			<?php $filename = substr($model->valor, stripos($model->valor, '_') + 1)?>
			<?php echo CHtml::link($filename .' <i class="icon icon-download"></i>', array('/projetoDespesa/downloadFile', 'file'=>$model->valor), array('class'=>'tip', 'title'=>"Baixar Arquivo"))?> <br/>
		<?php endif;?>
		
		<?php echo CHtml::fileField('ProjetoDespesaInfo[' .$key .'][valor]', $model->valor)?>
		
	<?php endif;?>
