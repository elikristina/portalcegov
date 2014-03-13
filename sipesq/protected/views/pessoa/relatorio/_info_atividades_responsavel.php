<br/>
<b>Atividades pelas quais é responsável</b>
	<div class="view">
			<?php 
			$atividades = $pessoa->getAtividadesResponsavelByDate($inicio, $termino, $atividadesResponsavelFinalizadas);
			foreach($atividades as $atividade):?>
				<div class="view <?php echo $atividade->class;?>">
			
				<b><?php echo CHtml::link(CHtml::encode($atividade->nome_atividade), array('atividade/view', 'id'=>$atividade->cod_atividade)); ?></b>
				<br />
			
				<b><?php echo CHtml::encode("Prazo"); ?>:</b>
				<?php echo CHtml::encode("De " .$atividade->data_inicio ." a " .$atividade->data_fim); ?>
				<br />
				<?php if (!empty($atividade->passos) && $atividadesResponsavelPassos==1){?>
					<div class="view" id="passos-holder">
						<?php foreach($atividade->passos as $passo):?>
						<div id="passo-<?php echo $passo->cod_passo?>" style="margin-bottom: 5px;">
							<div class="passo <?php echo $passo->finalizado ? "verde" : "amarelo"?>" style="padding: 5px;">
								<i class="icon icon-check" title="Atividade Finalizada" rel="tooltip"></i>
								<?php if($passo->finalizado==1)
										echo CHtml::encode("Passo Finalizado");
									else
										echo CHtml::encode("Passo não Finalizado");  ?><br/>
								
								<i class="icon icon-info-sign" title="DescriÃ§Ã£o" rel="tooltip"></i>
								<?php echo CHtml::encode($passo->descricao); ?>
								<br />
								
								<i class="icon icon-user" title="ResponsÃ¡vel" rel="tooltip"></i>
								<?php echo CHtml::encode($passo->pessoa->nome); ?>
								<br />
								
								<?php if($passo->finalizado==1):?>
									<i class="icon icon-calendar" title="Data de Conclusao" rel="tooltip"></i>
									<?php echo CHtml::encode($passo->data_finalizacao); ?>
								<?php else:?>
									<i class="icon icon-calendar" title="Prazo" rel="tooltip"></i>
									<?php echo CHtml::encode($passo->data_prazo); ?>
								<?php endif;?>
							</div>
						</div>
						
						<?php endforeach;?>
					</div>
				<?php }?>
				</div>
				
				
				
			<?php endforeach;?>
			<?php if(count($atividades) == 0):?>
			<div class="view verde"><p><b>Não é responsável por nenhuma atividade</b></p></div>
			<?php endif; ?>
		</div>
	