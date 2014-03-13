<?php //var @verba ProjetoVerba ?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Nome do Gasto</th>
<th>Rubrica</th>
<th>Data</th>
<th>Duração (meses)</th>
<th>Valor</th>
<th><?php echo CHtml::link('<i class="icon icon-plus"></i>' ,array('/projetoDespesa/create/','id'=>$projeto->cod_projeto), array('class'=>'tip', 'title'=>"Adicionar Despesa"))?></th>
</tr>
</thead>
<tbody>
<?php foreach($despesas as $desp):?>
		<tr class="desp-detail desp-<?php echo $desp->cod_rubrica?>">
		<td>
		<?php echo CHtml::link($desp->nome,array('/projetoDespesa/viewAjax', 'id'=>$desp->cod_despesa), array('class'=>'link', 'data-toggle'=>'modal', 'data-target'=>'#modal-info'));?>
		</td>
		<td><?php echo $desp->rubrica->nome;?></td>
		<td><?php echo Date('d/m/Y', strtotime($desp->data_compra));?></td>
		<td><?php echo CHtml::encode($desp->quantidade);?></td>
		<td>R$ <?php echo number_format($desp->valor, 2, ',','.');?></td>
		<td>
			<?php echo CHtml::link("<i class='icon icon-plus'></i>",array('/patrimonio/create', 'id'=>$desp->cod_despesa), array('class'=>'link tip', 'title'=>'Adicionar Patrimônio'));?>
			<?php echo CHtml::link("<i class='icon icon-search'></i>",array('/projetoDespesa/view', 'id'=>$desp->cod_despesa), array('class'=>'link tip', 'title'=>'Mais Informações'));?>
			<?php echo CHtml::link("<i class='icon icon-pencil'></i>",array('/projetoDespesa/update', 'id'=>$desp->cod_despesa) ,array('title'=>'Editar', 'class'=>'tip'))?>
			<?php echo CHtml::link("<i class='icon icon-trash'></i>",'#', array(
				'submit'=>array('/projetoDespesa/delete', 'id'=>$desp->cod_despesa),
				'confirm'=>"Você deseja deletar esta despesa?",
				'class'=>'tip',
				'title'=>'Excluir'
				
			))?>
		</td>
		</tr>
<?php endforeach;?>
</tbody>
</table>