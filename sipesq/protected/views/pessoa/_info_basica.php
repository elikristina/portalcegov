	<h5>Informações Pessoais</h5>
	<div class="view">
	<b><?php  echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	
	<b><?php echo CHtml::encode("Telefone"); ?>:</b>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />
	
	</div> <!-- Informações Pessoais -->
	
	<h5>Informações Acadêmicas</h5>
	<div class="view">
	
	<?php if(isset($data->categoria)):?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('categoria')); ?>:</b>
		<?php echo CHtml::encode($data->categoria->nome); ?>
		<br />
	<?php endif;?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('lattes')); ?>:</b>
	<b><?php echo CHtml::link(CHtml::encode($data->lattes), $data->lattes, array('target'=>'_blank')); ?></b>
	<br />
	
	<!-- COLOCAR ENDERECO -->
	
	<?php if(isset($data->cod_vinculo_institucional)):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_vinculo_institucional')); ?>:</b>
	<?php echo CHtml::encode($data->vinculo_institucional->nome); ?>
	<?php endif;?>
	</div> <!-- Informações Acadêmicas -->
