<?php /* @var $data Contato */?>
<div class="sresult">
	<i class="icon icon-user" rel="tooltip" title="Nome"></i>
	<b><?php echo CHtml::link(CHtml::encode($data->nome), array('/pessoa/view', 'id'=>$data->cod_pessoa)); ?></b>
	<br />

	<i class="icon icon-book"  rel="tooltip" title="Telefone"></i>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />
	
	<i class="icon icon-envelope"  rel="tooltip" title="Email"></i>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	
</div>

