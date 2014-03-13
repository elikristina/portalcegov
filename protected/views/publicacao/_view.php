<div class="view">
	<h4>
	<?php echo CHtml::link(CHtml::encode($data->titulo), array('view', 'id'=>$data->cod_publicacao)); ?>
<!--	<span style="float: right"><i><?php //echo CHtml::encode($data->tipo->nome)?></i></span>-->
	</h4>
	
	<p><?php echo CHtml::encode($data->descricao)?></p>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('autor')); ?>:</b>
	<?php echo CHtml::encode($data->autor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
	<?php echo CHtml::encode($data->ano); ?>
	<br />

	<?php echo CHtml::link(CHtml::encode('Download'),$data->href, array('target'=>'_blank')); ?>
	<br />

</div>