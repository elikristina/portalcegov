<div class="view">
<div class="row-fluid">
	<div class="span12">
			<h4><?php echo CHtml::link(CHtml::encode($data->nome), array('/projeto/view', 'id'=>$data->cod_projeto)) ?></h4>
			<div class="row-fluid">
				<div class="span6">
					<b><?php echo CHtml::encode($data->getAttributeLabel('data_inicio')); ?>:</b>
					<?php echo CHtml::encode(Sipesq::date($data->data_inicio)); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?>:</b>
					<?php echo CHtml::encode(Sipesq::date($data->data_fim)); ?>
					<br />

					<b><?php echo CHtml::encode("Situação do Projeto"); ?>:</b>
					<?php echo CHtml::encode($data->situacao_text); ?>
					<br />
					
					<b><?php echo CHtml::encode("Tipo de Projeto"); ?>:</b>
					<?php echo CHtml::encode($data->categoria->nome); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_projeto')); ?>:</b>
					<?php echo CHtml::encode($data->codigo_projeto); ?>
					<br />

					<b><?php echo CHtml::encode($data->getAttributeLabel('data_relatorio')); ?>:</b>
					<?php echo CHtml::encode(Sipesq::date($data->data_relatorio)); ?>
					<br />
					<?php if($data->skydrive): ?>
					<b><?php echo CHtml::encode($data->getAttributeLabel('skydrive')); ?>:</b>
					<?php echo CHtml::link('<i class="icon icon-cloud" style="color: #094AB2;"></i>'
									, $data->skydrive
									, array('target'=>'_blank', 'title'=>'Skydrive')); ?> <br />
					<?php endif; ?>
				</div>
				<div class="span6">
					<b>Orçamentado:</b> R$ <?php echo number_format($data->verba_orcamentada, 2, ',','.')?><br>
					<?php 
						$perc_recebido = $data->verba_orcamentada == 0 ? 0 : ($data->verba_recebida / $data->verba_orcamentada)*100;
						$perc_recebido = number_format($perc_recebido, 2, ',','.');

						$perc_comprometido = $data->verba_recebida == 0 ? 0 : ($data->gasto_comprometido / $data->verba_recebida)*100;
						$perc_comprometido = number_format($perc_comprometido, 2, ',', '.');

						$perc_saldo = $data->verba_recebida == 0 ? 0 : ($data->saldo_disponivel / $data->verba_recebida)*100;
						$perc_saldo = number_format($perc_saldo, 2, ',', '.');

					?>
					<b>Recebido:</b> R$ <?php echo number_format($data->verba_recebida, 2, ',','.')?> (<?php echo $perc_recebido ?>%)<br>
					<b>Gastos Comprometidos:</b> R$ <?php echo number_format($data->gasto_comprometido, 2, ',','.')?> (<?php echo $perc_comprometido ?>%)<br>
					<b>Saldo Disponível:</b> R$ <?php echo number_format($data->saldo_disponivel, 2, ',','.')?> (<?php echo $perc_saldo ?>%)<br>
					<?php echo CHtml::link('<i class="icon icon-print"></i> Relatório Completo', array('/projeto/relatorio', 'id'=>$data->cod_projeto), array('title'=>'Relatório Completo')); ?>
				</div>
			</div>
	</div>
</div> 
</div>	