<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesaInfo*/
?>
	
	
	<?php //echo CHtml::label($model->chave, 'ProjetoDespesaInfo[' .$key .'][valor]')?>
	<b><?php echo CHtml::encode($model->chave); ?>:</b>
	<?php if($model->tipo ==  RubricaCampo::CAMPO_TEXTO):?>
		<?php echo $model->valor?><br/>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_TEXTO_LONGO):?>
		<p><?php echo $model->valor?></p>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_DATA):?>
		<?php echo Sipesq::date($model->valor)?><br/>
	<?php endif;?>
	
	<?php if($model->tipo ==  RubricaCampo::CAMPO_ANEXO && ($model->valor != '')):?>
		<?php $filename = substr($model->valor, stripos($model->valor, '_') + 1)?>
		<?php echo CHtml::link($filename .' <i class="icon icon-download"></i>', array('/projetoDespesa/downloadFile', 'file'=>$model->valor), array('class'=>'tip', 'title'=>"Baixar Arquivo"))?> <br/>
		<?php //echo Yii::getPathOfAlias('application.data.despesas') .DIRECTORY_SEPARATOR .$model->valor?>
	<?php endif;?>
