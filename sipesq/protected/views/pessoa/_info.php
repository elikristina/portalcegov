	<h5>Informações Pessoais</h5>
	<div class="view">
	<b><?php  echo CHtml::encode($data->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($data->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_mae')); ?>:</b>
	<?php echo CHtml::encode($data->nome_mae); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascimento')); ?>:</b>
	<?php echo CHtml::encode(date("d/m/Y",strtotime($data->data_nascimento))); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	
	<b><?php echo CHtml::encode("Telefone"); ?>:</b>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpf')); ?>:</b>
	<?php echo CHtml::encode($data->cpf); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg')); ?>:</b>
	<?php echo CHtml::encode($data->rg); ?>
	<br />
	
	</div> <!-- Informações Pessoais -->

	<h5>Endereço</h5>
	<div class="view">
		<?php if ($data->endereco_residencial->tipo == 'residencial'): ?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('logradouro')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->logradouro . ', ' . $data->endereco_residencial->numero); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('complemento')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->complemento); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('bairro')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->bairro); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('Cidade')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->cidade); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('Estado')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->estado); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('cep')); ?>:</b>
			<?php echo CHtml::encode($data->endereco_residencial->cep); ?>
			<br />
		<?php else:?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('Logradouro')); ?>:</b>
			<?php echo CHtml::encode($data->rua_complemento); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('bairro')); ?>:</b>
			<?php echo CHtml::encode($data->bairro); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('cidade')); ?>:</b>
			<?php echo CHtml::encode($data->cidade); ?>
			<br />

			<b><?php echo CHtml::encode($data->getAttributeLabel('cep')); ?>:</b>
			<?php echo CHtml::encode($data->cep); ?>
			<br />
		<?php endif;?>
	</div>

	<h5>Informações Bancárias</h5>
	<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('banco')); ?>:</b>
	<?php echo CHtml::encode($data->banco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agencia')); ?>:</b>
	<?php echo CHtml::encode($data->agencia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('conta_corrente')); ?>:</b>
	<?php echo CHtml::encode($data->conta_corrente); ?>
	<br />
	
	<?php if(!empty($data->cod_banco)):?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('cod_banco')); ?>:</b>
		<?php echo CHtml::encode($data->cod_banco); ?>
		<br />
	<?php endif;?>
	</div> <!-- Informações Bancárias -->
	
	<h5>Informações Acadêmicas</h5>
	<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('cartao_ufrgs')); ?>:</b>
	<?php echo CHtml::encode($data->cartao_ufrgs); ?>
	<br />
	
	<?php if(isset($data->categoria)):?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('categoria')); ?>:</b>
		<?php echo CHtml::encode($data->categoria->nome); ?>
		<br />
	<?php endif;?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('lattes')); ?>:</b>
	<b><?php echo CHtml::link(CHtml::encode($data->lattes), $data->lattes, array('target'=>'_blank')); ?></b>
	<br />

	
	<?php if(isset($data->cod_vinculo_institucional)):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_vinculo_institucional')); ?>:</b>
	<?php echo CHtml::encode($data->vinculo_institucional->nome); ?>
	<?php endif;?>
	</div> <!-- Informações Acadêmicas -->	