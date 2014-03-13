<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Data</th>
<th>Valor</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach($desembolsos as $des):?>
		<tr>
			<td>
				<?php echo date('d/m/Y',strtotime($des->data))?>
			</td>
			<td>
				 R$ <?php echo number_format($des->valor, 2,',','.');?>
			</td>
			<td>
				<?php echo CHtml::link('<i class="icon-pencil tip" title="Editar"></i>', null)?>
				<?php echo CHtml::link('<i class="icon-trash tip" title="Excluir"></i>', null)?>
			</td>
			
		</tr>
<?php endforeach;?>
</tbody>
</table>
