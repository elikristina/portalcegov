<?php 
/*
 * @var $model Projeto
 * @var $receita ProjetoVerba
 * @var $rub Rubrica
 */
?>

<?php foreach($model->receitas as $receita):?>
	<?php foreach($receita->rubricas as $rub):?>
	
	 	<?php
	 		//$recebido = $rub->calculaReceitas($rub, $model->cod_projeto);
	 		$gasto_rubrica = $receita->gastosComprometidos($rub);
	 		$recebido = $gasto_rubrica
	 		+ min($receita->saldo_comprometido,
	 			 ($receita->projeto->getOrcamentado($rub->cod_rubrica) - $gasto_rubrica)
	 			  
	 		);
	 		$gasto_comprometido = $receita->gastosComprometidos($rub);
	 		$gasto_corrente = $receita->gastosCorrentes($rub);
	 	?>
		<div class="bar_chart span-24" 
		id="<?php echo $rub->cod_rubrica; ?>"
		data-orcamentado="<?php echo $model->getOrcamentado($rub->cod_rubrica);?>"
		data-recebido="<?php echo $recebido; ?>" 
		data-gasto-comprometido="<?php echo $gasto_comprometido; ?>" 
		data-gasto-corrente="<?php echo $gasto_corrente; ?>"
		data-saldo-disponivel="<?php echo ($recebido - $gasto_comprometido); ?>"
		data-saldo-corrente="<?php echo ($recebido - $gasto_corrente); ?>"
		<?php if( (count($receita->rubricas) < 2) //Se a receita possui somente uma ou zero rubricas
				 	||	($receita->recebido == $receita->getOrcamentado()) //Se o recebido do pote ja atingiu o orcamentado
					||	($gasto_comprometido == $model->getOrcamentado($rub->cod_rubrica)) // Se as despesas da rubrica ja atingiram o orcamentado dela
		):?>
					
			data-verba-compartilhada="false"
		<?php else:?>
			data-verba-compartilhada="true"
		<?php endif;?>
		
		data-rubrica="<?php echo $rub->nome; ?>"
		>
			<?php echo $rub->nome;?>
		</div>
		
		<div class="chart-table">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Orçamentado</th>
						<th>Recebido</th>
						<th>Gastos Comprometidos</th>
						<th>Gastos Correntes</th>
						<th>Saldo Disponível</th>
						<th>Saldo Corrente</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>R$ <?php echo number_format($model->getOrcamentado($rub->cod_rubrica), 2, ',','.');?></td>
					<td>R$ <?php echo number_format($recebido, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($gasto_comprometido, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($gasto_corrente, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($recebido - $gasto_comprometido, 2, ',','.'); //Saldo Disponivel?></td>
					<td>R$ <?php echo number_format($recebido - $gasto_corrente, 2, ',','.'); //Saldo Corrente?></td>
				</tr>
				</tbody>
			</table>
			
		</div>	
		
	 <?php endforeach;?>
 <?php endforeach;?>

 <div id="visualization"></div>