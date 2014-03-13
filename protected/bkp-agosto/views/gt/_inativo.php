<div class="view-vermelho">
	<h4><?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_gt)); ?></h4>
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_coordenador')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->coordenador->nome), array('/pessoa/view', 'id'=>$data->coordenador->cod_pessoa)	); ?>
	<br />
<!--	<p><b>OBS: Este Grupo de Trabalho está inativo</b></p>-->
	<b><?php echo CHtml::link('Editar', array('/gt/update', 'id'=>$data->cod_gt));?></b>
</div>