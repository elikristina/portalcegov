<h5>Projetos em que atua</h5>
	<div class="view">
	<table class="table table-striped table-hover">
		<tr><th>Projeto</th><th>Situação</th><th>Prazo</th></tr>
		<?php foreach($data->projetos_atuante as $projeto):?>
		<tr>
			<td><?php echo CHtml::link($projeto->nome, array('/projeto/view', 'id'=>$projeto->cod_projeto))?></td>
			<td><?php echo $projeto->situacao_text;?></td>
			<td><?php echo Sipesq::date($projeto->data_fim);?></td>
		</tr>
		<?php endforeach;?>
	</table>
	</div>