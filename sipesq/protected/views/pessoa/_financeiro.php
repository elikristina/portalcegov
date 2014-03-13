	<div class="view">
	<?php $despesas = ProjetoDespesa::model()->findAll(array('condition'=>"comprador ILIKE '%{$data->nome}%'")) ?>
	<?php if(count($despesas > 0)):?>	
	<table class="table table-bordered table-striped table-hover">
	<thead>
	<tr>
	<th>Nome do Gasto</th>
	<th>Rubrica</th>
	<th>Valor (R$)</th>
	<th>Quantidade</th>
	<th>Data</th>
	<th>Menu</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($despesas as $desp):?>
			<tr>
			<td>
			<?php echo CHtml::link($desp->nome,array('/projetoDespesa/viewAjax', 'id'=>$desp->cod_despesa), array('class'=>'link', 'data-toggle'=>'modal', 'data-target'=>'#modal-info'));?>
			</td>
			<td><?php echo $desp->rubrica->nome;?></td>
			<td><?php echo number_format($desp->valor, 2, ',','.');?></td>
			<td><?php echo CHtml::encode($desp->quantidade);?></td>
			<td><?php echo Date('d/m/Y', strtotime($desp->data_compra));?></td>
			<td>
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
	<?php endif;?>
	
	
	</div> <!-- Termina Tab Financeiro -->