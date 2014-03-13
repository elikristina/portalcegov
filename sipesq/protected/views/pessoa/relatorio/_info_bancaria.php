<br />
<b>Informações Bancárias</b>
<div class="view">

	<b><?php echo CHtml::encode($pessoa->getAttributeLabel('banco')); ?>:</b>
	<?php echo CHtml::encode($pessoa->banco); ?>
	<br />
	
	<b><?php echo CHtml::encode($pessoa->getAttributeLabel('agencia')); ?>:</b>
	<?php echo CHtml::encode($pessoa->agencia); ?>
	<br />
	
	<b><?php echo CHtml::encode($pessoa->getAttributeLabel('conta_corrente')); ?>:</b>
	<?php echo CHtml::encode($pessoa->conta_corrente); ?>
	<br />
	
	<?php if(!empty($pessoa->cod_banco)):?>
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cod_banco')); ?>:</b>
		<?php echo CHtml::encode($pessoa->cod_banco); ?>
		<br />
	<?php endif;?>
</div> <!-- Informa��es Banc�rias -->		
