<?php //var @verba ProjetoVerba ?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Gasto</th>
<th>Beneficiário(s)</th>
<th>Data</th>
<th>Duração (meses)</th>
<th>Valor</th>
</tr>
</thead>
<tbody>
<?php foreach($despesas as $desp):?>
		<tr>
		<td><?php echo $desp->rubrica->numero .' ' .$desp->rubrica->nome?></td>
		<td><?php echo $desp->comprador;?></td>
		<td><?php echo Date('d/m/Y', strtotime($desp->data_compra));?></td>
		<td align="center"><?php echo CHtml::encode($desp->quantidade);?></td>
		<td>R$ <?php echo number_format($desp->valor, 2, ',','.');?></td>
		</tr>
<?php endforeach;?>
</tbody>
</table>
