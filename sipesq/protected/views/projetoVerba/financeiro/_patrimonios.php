<?php //@var $verba ProjetoVerba?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Nome do Gasto</th>
<th>Número do Patrimônio</th>
<th>Localização</th>
<th>Valor</th>
<th></th>
</tr>
</thead>
<tbody>
<?php foreach($verba->despesas as $despesa):?>
	<?php foreach ($despesa->patrimonios as $patrimonio):?>
		<tr>
		<td><?php echo $patrimonio->despesa->nome;?></td>
		<td><?php echo $patrimonio->nro_patrimonio;?></td>
		<td><?php echo CHtml::encode($patrimonio->localizacao);?></td>
		<td>R$ <?php echo number_format($patrimonio->valor, 2, ',','.');?></td>
		<td>
			<?php echo CHtml::link('<i class="icon-search tip" title="Mais Informações"></i>', array('/patrimonio/view', 'id'=>$patrimonio->cod_patrimonio))?>
			<?php echo CHtml::link('<i class="icon-pencil tip" title="Editar"></i>', array('/patrimonio/update', 'id'=>$patrimonio->cod_patrimonio))?>
			<?php echo CHtml::link("<i class='icon-trash'></i>",'#', array(
				'submit'=>array('/patrimonio/delete', 'id'=>$patrimonio->cod_patrimonio),
				'confirm'=>"Você deseja deletar este patrimonio?",
				'class'=>'tip',
				'title'=>'Excluir'
			))?>
		</td>
		</tr>
	<?php endforeach;?>
<?php endforeach;?>
</tbody>
</table>