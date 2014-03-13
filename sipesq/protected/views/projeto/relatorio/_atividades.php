<?php if(count($model->atividades) < 1):?>
	<div class="view">Não há atividades cadastradas neste projeto</div>
<?php endif;?>
		
<?php foreach ($model->atividades_finalizadas as $atividade):?>
	<div class="view view-atividade">
		<div class="atv-nome">
			<?php echo CHtml::encode($atividade->nome_atividade); ?>
		</div>
		
		<div class="row-fluid">
		<div class="span2" id="atv-section">
			Categoria<span class="print">:</span>
		</div>
		<div class="span10" id="atv-text">
			<?php if(is_object($atividade->categoria)):?>
			<?php if($atividade->categoria->categoriaPai->cod_categoria != $atividade->categoria->cod_categoria ):?>
				<?php echo CHtml::encode($atividade->categoria->categoriaPai->nome);?> <b>&gt;</b> 
			<?php endif;?>
			 	<?php echo CHtml::encode($atividade->categoria->nome);?>
			<?php endif;?>
		</div>
	</div>
		<div class="row-fluid">
		<div class="span2" id="atv-section">
			Prazo<span class="print">: </span>
		</div>
		<div class="span10" id="atv-text">
			<?php echo Sipesq::date($atividade->data_inicio);?> a <?php echo Sipesq::date($atividade->data_fim);?>
		</div>
	</div>
		<div class="row-fluid">
		<div class="span2" id="atv-section">
			Responsável<span class="print">: </span>
		</div>
		<div class="span10" id="atv-text">
			<?php echo CHtml::encode($atividade->responsavel->nome); ?>
		</div>
	</div>
		<div class="row-fluid">
		<div class="span2" id="atv-section">
			Participantes<span class="print">: </span>
		</div>
		<div class="span10" id="atv-text">
			<?php $pess = array(); foreach($atividade->pessoas as $p) $pess[] = $p->nome; echo implode(', ', $pess); ?>
		</div>
	</div>
		<div class="row-fluid">
		<div class="span2" id="atv-section">
			Descrição<span class="print">: </span>
		</div>
		<div class="span10" id="atv-text">
			<span class="atv-desc"><?php echo $atividade->descricao ?></span>
		</div>
	</div>
	</div>
<?php endforeach;?>	