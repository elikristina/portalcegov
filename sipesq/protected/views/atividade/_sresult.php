<?php /* @var $data Contato */?>
<div class="sresult">
	
	<h5><i class="icon icon-briefcase" rel="tooltip" title="Atividade"></i> <?php echo CHtml::link(CHtml::encode($data->nome_atividade), array('/atividade/view', 'id'=>$data->cod_atividade)); ?></h5>
	
	<?php if($data->responsavel != null):?>
		<i class="icon icon-user"  rel="tooltip" title="Responsável"></i>
		<?php echo CHtml::link(CHtml::encode($data->responsavel->nome), array('/pessoa/view', 'id'=>$data->responsavel->cod_pessoa)); ?>
		<br />
	<?php endif;?>
	<br />
	<?php if($data->pessoas != null):?>
		<?php foreach ($data->pessoas as $key => $p) :?>
		<i class="icon icon-user"  rel="tooltip" title="Participante"></i>
		<?php echo CHtml::link(CHtml::encode($p->nome), array('/pessoa/view', 'id'=>$p->cod_pessoa)); ?>
		<br />
	<?php endforeach;?>
	<?php endif;?>

	<i class="icon icon-info-sign"  rel="tooltip" title="Situação"></i>
	<?php echo CHtml::encode($data->statusName); ?>
	<br />
</div>

