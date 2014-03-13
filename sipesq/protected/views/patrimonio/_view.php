<?php
/* @var $this PatrimonioController */
/* @var $data Patrimonio */
?>

<?php $data->valor = number_format($data->valor,2,',','.')?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_patrimonio)); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_patrimonio')); ?>:</b>
	<?php echo CHtml::encode($data->nro_patrimonio); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('valor')); ?>:</b>
	R$ <?php echo CHtml::encode($data->valor); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_projeto_despesa')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->despesa->nome), array('/projetoDespesa/view', 'id'=>$data->despesa->cod_despesa)); ?>
	<br />

	<b>Projeto:</b>
	<?php echo CHtml::link(CHtml::encode($data->despesa->projeto->nome), array('/projeto/view', 'id'=>$data->despesa->projeto->cod_projeto)); ?>
	<br />

</div>