<?php //@var $projeto Projeto?>
<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Rubrica</th>
					<th>Valor Orçamentado</th>
					<th><?php echo CHtml::link("<i class='icon icon-plus'></i>",array('/projetoOrcamento/create', 'id'=>$projeto->cod_projeto) ,array('title'=>'Adicionar', 'class'=>'tip'))?></th>
				</tr>
			</thead>
			<tbody id="table-orcamento">
			<?php foreach($projeto->orcamentos as $k=>$orc):?>
				<tr class="item-<?php echo $orc->cod_rubrica?>">
					<td><?php echo $orc->rubrica->nome ?></td>
					<td>R$ <?php echo number_format($orc->valor, 2, ',','.') ?></td>
					<td>
						<?php echo CHtml::link("<i class='icon icon-pencil'></i>",array('/projetoOrcamento/update', 'id'=>$orc->cod_orcamento) ,array('title'=>'Editar', 'class'=>'tip'))?>
						<?php echo CHtml::link("<i class='icon icon-trash'></i>",'#', array(
							'submit'=>array('/projetoOrcamento/delete', 'id'=>$orc->cod_orcamento),
							'confirm'=>"Você deseja deletar este orcamento?",
							'class'=>'tip',
							'title'=>'Excluir'
							
						))?>
					</td>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>
		<?php //echo CHtml::link('Gerenciar Orçamentos' ,array('/projeto/update/','id'=>$projeto->cod_projeto, '#'=>'orcamento'), array('class'=>'btn btn-small link'))?>