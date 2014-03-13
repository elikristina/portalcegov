<?php //@var $projeto Projeto?>
<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
<th>Recebimento</th>
<th>Rubricas</th>
<th>Recebido</th>
<th>Gasto</th>
<th>Saldo</th>
<th><?php echo CHtml::link('<i class="icon icon-plus"></i>' ,array('/projetoVerba/create/','id'=>$projeto->cod_projeto), array('class'=>'tip', 'title'=>"Adicionar Receita"))?></th>
</tr>
</thead>
<tbody>
<?php foreach($projeto->receitas as $i=>$rec):?>
		<tr>
		<td><?php echo CHtml::link('<b>#'.$rec->cod_verba . '</b> ' .date('m/Y',strtotime($rec->data_desembolso)),array('/projetoVerba/view', 'id'=>$rec->cod_verba))?></td>
		<td><?php
				$rubricas = Array(); foreach($rec->rubricas as $r){ $rubricas[] = $r->nome; } ;
				 echo CHtml::link(CHtml::encode(implode(', ', $rubricas)), array('/projetoVerba/view', 'id'=>$rec->cod_verba));
		 ?></td>
			<td>R$ <?php echo number_format($rec->recebido, 2, ',','.');?></td>
			<td>R$ <?php echo number_format($rec->gasto_comprometido, 2, ',','.');?></td>
			<td>R$ <?php echo number_format($rec->saldo_comprometido, 2, ',','.');?></td>
			<td>
				<?php echo CHtml::link('<i class="icon icon-plus"></i>' ,array('/projetoDespesa/create/','id'=>$projeto->cod_projeto), array('class'=>'tip', 'title'=>"Adicionar Despesa"))?>
				<?php echo CHtml::link("<i class='icon icon-search'></i>",array('/projetoVerba/view', 'id'=>$rec->cod_verba), array('class'=>'link tip', 'title'=>'Mais Informações'));?>
				<?php echo CHtml::link("<i class='icon icon-pencil'></i>",array('/projetoVerba/update', 'id'=>$rec->cod_verba, 'ajax'=>false) ,array('title'=>'Editar', 'class'=>'tip' /*, 'data-toggle'=>'modal', 'data-target'=>'#modal-info' */))?>
				<?php echo CHtml::link("<i class='icon icon-trash'></i>",'#', array(
					'submit'=>array('/projetoVerba/delete', 'id'=>$rec->cod_verba),
					'confirm'=>"Você deseja deletar esta receita?",
					'class'=>'tip',
					'title'=>'Excluir'
					
				))?>
			</td>
		</tr>
<?php endforeach;?>
</tbody>
</table>
