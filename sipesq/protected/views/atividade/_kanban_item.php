<div class="kanban-item">
<div class="view atividade <?php echo $data->class;?>" atv-id="<?php echo $data->cod_atividade ?>" style="border-color: <?php echo ($data->cod_pessoa == Yii::app()->user->getId())?'#000':'#ccc' ?>;">
	<div style="float: left; margin-right: 5px;">
		<i class="icon icon-user" data-title="<?php echo $data->responsavel->nome?>" rel="tooltip" data-placement="right"></i>
	</div>
		<b><?php echo CHtml::link(CHtml::encode($data->nome_atividade), array('atividade/view', 'id'=>$data->cod_atividade)); ?></b>
		<!-- <button class="update-form-button ui-icon ui-icon-pencil" cod_atividade="<?php echo $data->cod_atividade ?>"></button> !-->
	<div style="clear: both"></div>
	<?php if(count($data->meus_passos) > 0): ?>
	<hr>
	<b>Passos</b>
<!--		    <span title="Passos Ativos" class="ui-icon ui-icon-circle-triangle-e drop-button"></span> -->
			<div class="atv-passos2">	
			
			<?php if($data->cod_pessoa == Yii::app()->user->getId()):?>
				<span class="ui-icon ui-icon-circle-triangle-e drop-button"></span> 
				<div class="atv-passos hidden">	
				<?php foreach($data->passos as $p):?>
					<?php if(!$p->finalizado)$this->renderPartial('/atividade/passo/_passo', array('model'=>$p))?>
				<?php endforeach;?>
				</div>
			<?php else:?>
				<?php foreach($data->meus_passos as $p):?>
					<?php if(!$p->finalizado)$this->renderPartial('/atividade/passo/_passo', array('model'=>$p))?>
				<?php endforeach;?>
			<?php endif;?>
			
			
			
			</div>
		<?php
		 /*
		    <span title="Passos Finalizados" class="ui-icon ui-icon-circle-triangle-e drop-button"></span> 
			<div class="atv-passos hidden">	
			<?php foreach($data->meus_passos as $p):?>
				<?php if($p->finalizado)$this->renderPartial('/atividade/passo/_passo', array('model'=>$p))?>
			<?php endforeach;?>
			</div>
		*/ 
		?>
		
		
	<?php endif;?>
</div>
</div>


