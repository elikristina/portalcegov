<br/>
<b>Bolsas e Outros Recebimentos</b>
<div class="view">


	<?php if(count($pessoa->pessoa_financeiro) < 1):?>
		<h4> Não há pagamentos</h4>
	<?php else:?>
		<?php $total_recebido = 0; $total_receber = 0?>
		<table>
		<tr><th>Fonte Pagadora</th><th>Categoria</th><th>Projeto Vinculado</th><th>Valor</th><th>Início</th><th>Fim</th></tr>
		<?php foreach($pessoa->pessoa_financeiro as $pagamento): ?>
		<tr class="tbl-line-financeiro <?php echo $pagamento->class;?>" id="<?php echo $pagamento->cod_financeiro?>">
			<td><?php echo CHtml::encode($pagamento->fontePagadora->nome);?></td>
			<td><?php echo CHtml::encode($pagamento->categoria);?></td>
			<td><?php echo CHtml::encode($pagamento->projeto->nome);?></td>
			<td>R$ <?php echo  CHtml::encode(number_format($pagamento->valor,2,',','.')); ?></td>
			<td><?php echo CHtml::encode($pagamento->data_fim);?></td>
			<td><?php echo CHtml::encode($pagamento->data_relatorio);?></td>
			<?php $total_recebido += $pagamento->valor_recebido?>
			<?php $total_receber += $pagamento->valor_total?>
		</tr>
		<?php endforeach;?>
		
		<tr class="line-last ">
			<td colspan="2"><b>Total Recebido</b></td>
			<td colspan="5" style="text-align: right;">
				<b><?php  echo CHtml::encode(number_format($total_recebido,2,',','.'));?></b>
			</td>
		</tr>
		<tr class="line-last">
			<td colspan="2"><b>Total</b></td>
			<td colspan="5" style="text-align: right;"><b><?php  echo CHtml::encode(number_format($total_receber,2,',','.'));?></b></td>
		</tr>
		</table>
		<div id="fin-detail">
		</div>
<?php endif;?>
</div><!-- Informações Financeiras-->