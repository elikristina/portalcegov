<h4 class="gt-item" id="h4"><a href="#"><?php echo CHtml::encode($data->nome);?></a></h4>
	<div id="div-filho">
		
		<b><?php echo CHtml::encode($data->getAttributeLabel('cod_coordenador')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->coordenador->nome), array('/pessoa/view', 'id'=>$data->coordenador->cod_pessoa)	); ?>
		<br />
		<?php echo $data->apresentacao; ?>
		<br>
		<?php echo CHtml::link("Mais Informações",array('view', 'id'=>$data->cod_gt),array('class'=>"button",));?>
		<br />
	</div>
