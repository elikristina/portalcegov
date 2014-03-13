<?php 
//@var verba ProjetoVerba
?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Data</th>
<th>Valor</th>
<th><?php echo CHtml::link('<i class="icon-plus tip" title="Adicionar Desembolso"></i>', array('/projetoVerba/createDesembolso', 'id'=>$verba->cod_verba))?></th>
</tr>
</thead>
<tbody>
<?php foreach($verba->desembolsos as $des):?>
		<tr>
			<td>
				<?php echo date('d/m/Y',strtotime($des->data))?>
			</td>
			<td>
				 R$ <?php echo number_format($des->valor, 2,',','.');?>
			</td>
			<td>
				<?php echo CHtml::link('<i class="icon-pencil tip" title="Editar"></i>', array('/projetoVerba/updateDesembolso', 'id'=>$des->cod_desembolso))?>
				<?php echo CHtml::link("<i class='icon icon-trash'></i>",'#', array(
				'submit'=>array('/projetoVerba/deleteDesembolso', 'id'=>$des->cod_desembolso),
				'confirm'=>"Você deseja deletar este desembolso?",
				'class'=>'tip',
				'title'=>'Excluir'
				
			))?>
			</td>
			
		</tr>
<?php endforeach;?>
</tbody>
</table>
