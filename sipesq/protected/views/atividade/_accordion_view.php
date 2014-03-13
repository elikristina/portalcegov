<div class="accordion" id="accordion_view">
<?php foreach ($atividades as $data):?>
  <div class="accordion-group">
    <div class="accordion-heading" >
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion_view" href="#collapse<?php echo $data->cod_atividade ?>">
        <?php echo CHtml::encode($data->nome_atividade);?>
        <span class="pull-right label <?php echo $data->label?>"><?php echo CHtml::encode(Sipesq::date($data->data_fim));?></span>
      </a>
    </div>
    <div id="collapse<?php echo $data->cod_atividade?>" class="accordion-body collapse in">
      <div class="accordion-inner">
		     
		     <b><?php echo CHtml::encode($data->getAttributeLabel('cod_pessoa')); ?>:</b>
			<?php echo CHtml::encode($data->responsavel->nome); ?>
			<br />

			<b>Categoria:</b>
			<?php if(is_object($data->categoria)):?>
			<?php if($data->categoria->categoriaPai->cod_categoria != $data->categoria->cod_categoria ):?>
				<?php echo CHtml::encode($data->categoria->categoriaPai->nome);?> <b>&gt;</b> 
			<?php endif;?>
			 <?php echo CHtml::encode($data->categoria->nome);?>
			<?php endif;?>
				
			<br />
		
			<b>Participantes:</b>
			<?php $pessoas = array_map(function($p){return trim($p->nome);}, $data->pessoas)?>
			<?php echo implode(', ', $pessoas); echo (count($pessoas) > 0) ? '.':''?>
			<br />
			
			<b>Projetos:</b>
			<?php foreach($data->projetos as $proj):?>
				<?php echo CHtml::encode($proj->nome)?>, 
			<?php endforeach;?>
			<br />
		
			<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
			<span class="label <?php echo $data->label?>"><?php echo CHtml::encode($data->statusName); ?></span><br/>
			<?php echo CHtml::link("<span title='Mais Informaçoes'>Mais Informaçoes</span> ", array('atividade/view', 'id'=>$data->cod_atividade)); ?>
			<br />
      </div> <!-- /collapse inner -->
    </div>
  </div>
  <?php endforeach;?>
</div>

