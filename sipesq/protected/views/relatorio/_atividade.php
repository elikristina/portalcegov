<div class="view atividade <?php echo $data->class;?>">

	<b><?php echo CHtml::link(CHtml::encode($data->nome_atividade), array('view', 'id'=>$data->cod_atividade)); ?></b>
	 ( <?php echo CHtml::encode($data->data_inicio);?> a <?php echo CHtml::encode($data->data_fim);?> )
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_pessoa')); ?>:</b>
	<?php echo CHtml::encode($data->responsavel->nome); ?>
	<br />
	
	
	<b>Categoria:</b>
	<?php if(is_object($data->categoria)):?>
	<?php if($data->categoria->categoriaPai->cod_categoria != $data->categoria->cod_categoria ):?>
		<?php echo CHtml::encode($data->categoria->categoriaPai->nome);?> <b>&gt;</b> 
	<?php endif;?>
	 <?php echo CHtml::encode($data->categoria->nome);?>
	<?php endif;?>
		
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

</div>