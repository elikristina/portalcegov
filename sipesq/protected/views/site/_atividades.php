<div class="view">
<h4><b>Suas Atividades Pendentes</b></h4>
		<!-- Atividades que terminam -->
			<?php $atividades = Atividade::getAllByUser($user);	?>
			<div class="view-right">
			<?php if(count($atividades) > 0):?>
				
					<p><b>Atividades que participa (<?php echo count($atividades);?>)</b></p> 
					<div class="view-scroll">
						<?php foreach ($atividades as $a):?>
							<div class="view <?php echo $a->class?>">
						 		<b><?php echo CHtml::link($a->nome_atividade, array('/atividade/view', 'id'=>$a->cod_atividade));?></b><br>
						 		<b>Prazo:</b> <?php echo date("d/m/Y", strtotime($a->data_fim))?><br>
						 	</div>
						<?php endforeach;?>
					</div>
			<?php else:?>
				<p><b>Não participa de nenhuma atividade no momento</b></p>
			<?php endif;?>
			</div>
			
		
			<?php $atividades_responsavel = Atividade::getAllRespByUser($user);	?>
			<div class="view-left">			
			<?php if(count($atividades_responsavel) > 0):?>
					<p><b>Atividades o qual é responsável (<?php echo count($atividades_responsavel);?>)</b> </p> 
					<div class="view-scroll">
						<?php foreach ($atividades_responsavel as $a):?>
						 	<div class="view <?php echo $a->class?>">
						 		<b><?php echo CHtml::link($a->nome_atividade, array('/atividade/view', 'id'=>$a->cod_atividade));?></b><br>
						 		<b>Prazo:</b> <?php echo date("d/m/Y", strtotime($a->data_fim))?><br>
						 	</div>
						<?php endforeach;?>
					</div>
			<?php else:?>
				<p><b>Não é responsável por nenhuma atividade no momento</b></p>
			<?php endif;?>
			</div>
			<div style="clear:both;"> </div>
</div>