<?php $projetos = Projeto::getLasts();?>
<?php $bolsas = PessoaFinanceiro::getLasts();?>

<?php if((count($bolsas) > 0) || (count($projetos) > 0)):?>
	<div class="view">
	<h4><b>Pendências</b></h4>
<?php else:?>
	<div class="view">
	<b>Pendências:</b><br>
	<i><b>Não há pendências que terminam dentro de 6 meses.</b></i>
	</div>
<?php endif;?>

		<!--  Projetos que terminan -->
		
		<?php if(count($projetos) > 0):?>
			<div class="view-left">
				<p><b>Projetos que Terminam Dentro de 6 Meses (<?php echo count($projetos);?>)</b></p>
				<div class="view-scroll">
					<?php foreach ($projetos as $p):?>
					<div class="view">
						<b><?php echo CHtml::link($p->nome, array('/projeto/view', 'id'=>$p->cod_projeto));?></b><br>
						<b>Prazo:</b> <?php echo date("d/m/Y", strtotime($p->data_fim))?><br>
						<b>Situação:</b><span class="label <?php echo $p->class?>"><?php echo CHtml::encode($p->situacao_text); ?></span>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
		
		<!-- Bolsas que terminam -->
		
		<?php if(count($bolsas) > 0):?>
			<div class="view-right">
				<p><b>Bolsas que Terminam Dentro de 6 Meses (<?php echo count($bolsas);?>)</b></p>
				<div class="view-scroll">
					<?php foreach ($bolsas as $b):?>
					<div class="view">
						<b><?php echo CHtml::link($b->categoria . ' - ' .$b->pessoa->nome, array('/pessoaFinanceiro/view', 'id'=>$b->cod_financeiro));?></b><br>
						<b>Prazo:</b> <span class="label <?php echo $p->class?>"><?php echo date("d/m/Y", strtotime($b->data_fim))?></span><br>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		<?php endif;?>
		<div style="clear: both;"></div>
	</div>