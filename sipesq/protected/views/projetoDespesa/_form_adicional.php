<?php
/* @var $this ProjetoDespesaController */
/* @var $model Rubrica */
?>

<?php  for($i=0; $i < count($model->campos); $i++):?>
	
	<?php $cmp = $model->campos[$i];?>

	<?php echo CHtml::hiddenField('ProjetoDespesaInfo[' .$i .'][chave]', $cmp->chave)?>
	<?php echo CHtml::hiddenField('ProjetoDespesaInfo[' .$i .'][tipo]', $cmp->tipo)?>
	
	<?php echo CHtml::label($cmp->chave, 'ProjetoDespesaInfo[' .$i .'][valor]')?>
	
	<?php if($cmp->tipo ==  RubricaCampo::CAMPO_TEXTO):?>
		<?php echo CHtml::textField('ProjetoDespesaInfo[' .$i .'][valor]', '', array('class'=>'input-xxlarge'))?>
	<?php endif;?>
	
	<?php if($cmp->tipo ==  RubricaCampo::CAMPO_TEXTO_LONGO):?>
		<?php echo CHtml::textArea('ProjetoDespesaInfo[' .$i .'][valor]', '')?>
	<?php endif;?>
	
	<?php if($cmp->tipo ==  RubricaCampo::CAMPO_DATA):?>
		<?php echo CHtml::tag('input', array('name'=>'ProjetoDespesaInfo[' .$i .'][valor]', 'type'=>'date', 'value'=>date('Y-m-d')))?>
	<?php endif;?>
	
	<?php if($cmp->tipo ==  RubricaCampo::CAMPO_ANEXO):?>
		<?php echo CHtml::fileField('ProjetoDespesaInfo[' .$i .'][valor]')?>
	<?php endif;?>
	
<?php endfor;?>
