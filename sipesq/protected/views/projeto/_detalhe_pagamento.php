<div class="detalhe_pagamento <?php echo $pagamento->class; ?>" >
	<b><?php echo CHtml::encode("Início"); ?>:</b>
	<?php echo CHtml::encode($pagamento->data_inicio); ?>
	<br />
	
	<b><?php echo CHtml::encode("Término"); ?>:</b>
	<?php echo CHtml::encode($pagamento->data_fim); ?>
	<br />
	
	<b><?php echo CHtml::encode("Status"); ?>:</b>
	<?php echo CHtml::encode($pagamento->status); ?>
	<br />
	
	<b><?php echo CHtml::encode("Vigência"); ?>:</b>
	<?php echo CHtml::encode($pagamento->vigencia); ?>
	<br />
	
	<b><?php echo CHtml::encode("Meses Trabalhados"); ?>:</b>
	<?php echo CHtml::encode($pagamento->meses_trabalhados); ?>
	<br />
	
	<b><?php echo CHtml::encode("Valor já recebido"); ?>:</b>
	R$ <?php echo CHtml::encode(number_format($pagamento->valor_recebido,2,',','.')); ?>
	(<?php  echo CHtml::encode(number_format($pagamento->percentagem_recebida ,2,',','.') )?>%)
	<br />
	
	
	
	<b><?php echo CHtml::encode("Total a receber no período"); ?>:</b>
	R$ <?php echo CHtml::encode(number_format($pagamento->valor_total,2,',','.')); ?>
	<br />
</div>