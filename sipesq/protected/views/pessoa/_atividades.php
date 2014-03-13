<h3>Atividades</h3>
<ul class="nav nav-pills" id="nav-atividades">
  <li class="active"><a href="#atv-responsavel" data-toggle="tab">Responsável</a></li>
  <li><a href="#atv-participante" data-toggle="tab">Que Participa</a></li>
  <li><a href="#passos" data-toggle="tab">Tarefas / Passos</a></li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="atv-responsavel">
  	<?php $atividades = Atividade::model()->findAll('cod_pessoa = ' .$data->cod_pessoa);?>
		
		<p align="left"><b>Atividades que você é responsável</b></p>
			<?php foreach($atividades as $atividade):?>
				<?php $this->renderPartial('/atividade/_view', array('data'=>$atividade))?>
			<?php endforeach;?>
			<?php if(count($atividades) == 0):?>
			<div class="view verde"><p><b>Não é responsável por nenhuma atividade</b></p></div>
			<?php endif;?>
  </div>
  
  <div class="tab-pane" id="atv-participante">
  <p align="left"><b>Atividades que você participa</b></p>
  	<?php foreach($data->atividades as $atividade):?>
			<?php if($atividade->cod_pessoa != $data->cod_pessoa):?>
				<?php $this->renderPartial('/atividade/_view', array('data'=>$atividade))?>
			<?php endif;?>
		<?php endforeach;?>
		<?php if(count($data->atividades) == 0):?>
			<div class="view verde"><p><b>Não participa de nenhuma atividade</b></p></div>
		<?php endif;?>
  </div>
  
  <div class="tab-pane" id="passos">
  	<p align="left"><b>Tarefas atribuídas a você</b></p>
  	<?php $passos = AtividadePasso::model()->findAll('cod_pessoa = ' .$data->cod_pessoa);?>
  	<table class="table table-bordered table-striped table-hover">
  	  <thead>
	    <tr>
	      <th>Descrição</th>
	      <th>Prazo</th>
	      <th>Status</th>
	      <th>Atividade Vinculada</th>
	    </tr>
	    <tbody>
	  	<?php foreach($passos as $passo):?>
	  		<tr>
	  		<td><?php echo $passo->descricao?></td>
	  		<td><?php echo Sipesq::date($passo->data_prazo)?></td>
	  		<td>
	  		<?php if($passo->finalizado): ?>
	  		Finalizado em <?php echo Sipesq::date($passo->data_finalizacao)?>
	  		<?php else:?>
	  		Em aberto
	  		<?php endif;?>
	  		</td>
	  		<td><?php echo CHtml::link($passo->atividade->nome_atividade, array('/atividade/view', 'id'=>$passo->cod_atividade))?></td>
	  		</tr>
	  	<?php endforeach;?>
	  	</tbody>
  	</table>
  </div>
</div>
