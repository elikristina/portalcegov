<?php /* @var $data Contato */?>
<div class="sresult">
	
	<h5><i class="icon icon-briefcase" rel="tooltip" title="Projeto"></i> <?php echo CHtml::link(CHtml::encode($data->nome), array('/projeto/view', 'id'=>$data->cod_projeto)); ?></h5>
	
	<?php if($data->coordenador != null):?>
		<i class="icon icon-user"  rel="tooltip" title="Coordenador"></i>
		<?php echo CHtml::link(CHtml::encode($data->coordenador->nome), array('/pessoa/view', 'id'=>$data->coordenador->cod_pessoa)); ?>
		<br />
	<?php endif;?>
	
	<?php if($data->vice_coordenador != null):?>
		<i class="icon icon-user"  rel="tooltip" title="Vice-Coordenador"></i>
		<?php echo CHtml::link(CHtml::encode($data->vice_coordenador->nome), array('/pessoa/view', 'id'=>$data->vice_coordenador->cod_pessoa)); ?>
		<br />
	<?php endif;?>
	
	<?php if($data->fiscal != null):?>
		<i class="icon icon-user"  rel="tooltip" title="Fiscal"></i>
		<?php echo CHtml::link(CHtml::encode($data->fiscal->nome), array('/pessoa/view', 'id'=>$data->fiscal->cod_pessoa)); ?>
		<br />
	<?php endif;?>

	<?php if($data->bolsista_responsavel != null):?>
		<i class="icon icon-user"  rel="tooltip" title="Bolsista Responsável"></i>
		<?php echo CHtml::link(CHtml::encode($data->bolsista_responsavel->nome), array('/pessoa/view', 'id'=>$data->bolsista_responsavel->cod_pessoa)); ?>
		<br />
	<?php endif;?>
	
	<i class="icon icon-info-sign"  rel="tooltip" title="Situação"></i>
	<?php echo CHtml::encode($data->situacao_text); ?>
	<br />
</div>

