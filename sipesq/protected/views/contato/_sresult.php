<?php /* @var $data Contato */?>
<div class="sresult">

	<i class="icon icon-user" rel="tooltip" title="Nome"></i>
	<b><?php echo CHtml::link(CHtml::encode($data->nome), array('/contato/view', 'id'=>$data->cod_contato)); ?></b>
	<br />

	<i class="icon icon-book"  rel="tooltip" title="Telefone"></i>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />
	
	<i class="icon icon-envelope"  rel="tooltip" title="Email"></i>
	<?php echo CHtml::encode($data->email); ?>
	<br />
	
	<i class="icon icon-briefcase"  rel="tooltip" title="Instituição"></i>
	<?php echo CHtml::encode($data->instituicao); ?>
	<br />
	
	<i class="icon icon-info-sign"  rel="tooltip" title="Descrição"></i>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />
	
</div>

