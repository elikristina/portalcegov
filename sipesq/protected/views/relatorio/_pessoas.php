<div class="view pessoas <?php echo $data->class;?>">

	<b><?php echo CHtml::link(CHtml::encode($data->nome_atividade), array('view', 'id'=>$data->cod_atividade)); ?></b>
	 ( <?php echo CHtml::encode($data->data_inicio);?> a <?php echo CHtml::encode($data->data_fim);?> )
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_pessoa')); ?>:</b>
	<?php echo CHtml::encode($data->responsavel->nome); ?>
	<br />

	<b>Pessoas:</b>
	<?php foreach($data->pessoas as $pess):?>
		<?php echo CHtml::encode($pess->nome)?>, 
	<?php endforeach;?>
	<br />
	
	<b>Projetos:</b>
	<?php foreach($data->projetos as $proj):?>
		<?php echo CHtml::encode($proj->nome)?>, 
	<?php endforeach;?>
	<br />

</div>