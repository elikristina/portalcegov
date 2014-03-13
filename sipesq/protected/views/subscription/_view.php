<div class="view">
	<b><?php echo CHtml::link(CHtml::encode($data->titulo), array('view', 'id'=>$data->id)); ?></b>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('preco')); ?>:</b>
	<?php echo CHtml::encode($data->preco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('senha')); ?>:</b>
	<?php echo CHtml::encode($data->senha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('validade')); ?>:</b>
	<?php echo CHtml::encode($data->validade); ?>
	<br />
	
	<b><?php echo CHtml::Link("Link", $data->link, array("target"=>"_blank")); ?></b>

	

</div>