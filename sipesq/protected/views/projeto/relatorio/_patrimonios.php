<?php //@var $verba ProjetoVerba?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Nome do Gasto</th>
<th>Número do Patrimônio</th>
<th>Localização</th>
<th>Valor</th>
</tr>
</thead>
<tbody>
<?php foreach($despesas as $despesa):?>
	<?php foreach ($despesa->patrimonios as $patrimonio):?>
		<tr>
		<td><?php echo $patrimonio->despesa->nome;?></td>
		<td><?php echo $patrimonio->nro_patrimonio;?></td>
		<td><?php echo CHtml::encode($patrimonio->localizacao);?></td>
		<td>R$ <?php echo number_format($patrimonio->valor, 2, ',','.');?></td>
		</tr>
	<?php endforeach;?>
<?php endforeach;?>
</tbody>
</table>