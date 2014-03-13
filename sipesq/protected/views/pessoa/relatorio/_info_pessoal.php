<p align="left"><b>Informações Pessoais</b></p>
<div class="view">
<b><?php  echo CHtml::encode($pessoa->getAttributeLabel('nome')); ?>:</b>
		<?php echo CHtml::encode($pessoa->nome); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('nome_mae')); ?>:</b>
		<?php echo CHtml::encode($pessoa->nome_mae); ?>
		<br />
		
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('data_nascimento')); ?>:</b>
		<?php echo CHtml::encode(date("d/m/Y",strtotime($pessoa->data_nascimento))); ?>
		<br />
		
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('email')); ?>:</b>
		<?php echo CHtml::encode($pessoa->email); ?>
		<br />
		
		<b><?php echo CHtml::encode("Telefone"); ?>:</b>
		<?php echo CHtml::encode($pessoa->telefone); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cpf')); ?>:</b>
		<?php echo CHtml::encode($pessoa->cpf); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('rg')); ?>:</b>
		<?php echo CHtml::encode($pessoa->rg); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cidade')); ?>:</b>
		<?php echo CHtml::encode($pessoa->cidade); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('rua_complemento')); ?>:</b>
		<?php echo CHtml::encode($pessoa->rua_complemento); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('bairro')); ?>:</b>
		<?php echo CHtml::encode($pessoa->bairro); ?>
		<br />
	
		<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cep')); ?>:</b>
		<?php echo CHtml::encode($pessoa->cep); ?>
		<br />
		
		</div> <!-- Informa��es Pessoais -->
