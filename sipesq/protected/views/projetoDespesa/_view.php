<?php
/* @var $this ProjetoDespesaController */
/* @var $data ProjetoDespesa */
?>

<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_despesa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cod_despesa), array('view', 'id'=>$data->cod_despesa)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_rubrica')); ?>:</b>
	<?php echo CHtml::encode($data->cod_rubrica); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	<?php echo CHtml::encode($data->valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comprador')); ?>:</b>
	<?php echo CHtml::encode($data->comprador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_compra')); ?>:</b>
	<?php echo CHtml::encode($data->data_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_projeto')); ?>:</b>
	<?php echo CHtml::encode($data->cod_projeto); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('documento')); ?>:</b>
	<?php echo CHtml::encode($data->documento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inclusao')); ?>:</b>
	<?php echo CHtml::encode($data->data_inclusao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_criador')); ?>:</b>
	<?php echo CHtml::encode($data->cod_criador); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_edicao')); ?>:</b>
	<?php echo CHtml::encode($data->data_edicao); ?>
	<br />

	*/ ?>

</div>