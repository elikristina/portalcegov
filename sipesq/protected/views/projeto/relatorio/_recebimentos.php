<?php //@var $projeto Projeto?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Recebimento</th>
<th>Rubricas</th>
<th>Recebido</th>
<th>Gasto</th>
<th>Saldo</th>
</tr>
</thead>
<tbody>
<?php foreach($projeto->receitas as $i=>$rec):?>
		<tr>
		<td><?php echo '<b>#'.$rec->cod_verba . '</b> ' .date('m/Y',strtotime($rec->data_desembolso))?></td>
		<td><?php
				$rubricas = Array(); foreach($rec->rubricas as $r){ $rubricas[] = trim($r->nome); } ;
				 echo CHtml::encode(implode(', ', $rubricas));
		 ?></td>
			<td>R$ <?php echo number_format($rec->recebido, 2, ',','.');?></td>
			<td>R$ <?php echo number_format($rec->gasto_comprometido, 2, ',','.');?></td>
			<td>R$ <?php echo number_format($rec->saldo_comprometido, 2, ',','.');?></td>
		</tr>
<?php endforeach;?>
</tbody>
</table>