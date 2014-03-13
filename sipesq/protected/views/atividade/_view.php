<div class="view atividade" <?php echo $data->isParticipating() ? 'style="background-color: #ecf0f1;"' : '' ?>>

	<b><?php echo CHtml::link(CHtml::encode($data->nome_atividade), array('atividade/view', 'id'=>$data->cod_atividade)); ?></b>
	 ( <?php echo CHtml::encode(Sipesq::date($data->data_inicio));?> a <?php echo CHtml::encode(Sipesq::date($data->data_fim));?> )
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

	<b>Participantes:</b>
	<?php $pessoas = array_map(function($p){return trim($p->nome);}, $data->pessoas)?>
	<?php echo implode(', ', $pessoas); echo (count($pessoas) > 0) ? '.':''?>
	<br />
	
	<b>Projetos:</b>
	<?php foreach($data->projetos as $proj):?>
		<?php echo CHtml::encode($proj->nome)?>, 
	<?php endforeach;?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<span class="label <?php echo $data->label?>"><?php echo CHtml::encode($data->statusName); ?></span>
	<br />

</div>