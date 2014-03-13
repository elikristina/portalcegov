<?php /* @var $data Contato */?>
<div class="view">	
<div class="row-fluid">

<div class="span11">
	<i class="icon icon-user" rel="tooltip" title="Nome"></i>
	<?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_contato)); ?>
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
<div class="span1">
	<?php if(Sipesq::getPermition('acervo.contatos') >=100): ?>
		<i class="icon icon-pencil" rel="tooltip" title="Editar"></i>
		<?php echo CHtml::link("Editar", array('update', 'id'=>$data->cod_contato)); ?>
	<?php endif; ?>
</div>	
</div>
</div>

