<?php //@var $projeto Projeto?>
<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Rubrica</th>
					<th>Valor Orçamentado</th>
				</tr>
			</thead>
			<tbody id="table-orcamento">
			<?php foreach($projeto->orcamentos as $k=>$orc):?>
				<tr class="item-<?php echo $orc->cod_rubrica?>">
					<td><?php echo $orc->rubrica->nome ?></td>
					<td>R$ <?php echo number_format($orc->valor, 2, ',','.') ?></td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php echo CHtml::link('Gerenciar Orçamentos' ,array('/projeto/update/','id'=>$projeto->cod_projeto, '#'=>'orcamento'), array('class'=>'btn btn-small link'))?>