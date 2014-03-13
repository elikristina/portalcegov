<h4>Informações Gerais</h4>
<div class="view">
<div class="row-fluid">
<div class="span6">
	<b><?php echo CHtml::encode($model->getAttributeLabel('nome_curto')); ?>:</b>
	<?php echo CHtml::encode($model->nome_curto); ?>
	<br />

	<b><?php echo CHtml::encode("Situação do Projeto"); ?>:</b>
	<?php echo CHtml::encode($model->situacao_text); ?>
	<br />
	
	<b><?php echo CHtml::encode("Tipo de Projeto"); ?>:</b>
	<?php echo CHtml::encode($model->categoria->nome); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('natureza')); ?>:</b>
	<?php echo CHtml::encode($model->natureza); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('gt')); ?>:</b>
	<?php echo CHtml::encode($model->gt); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('codigo_projeto')); ?>:</b>
	<?php echo CHtml::encode($model->codigo_projeto); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('data_inicio')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_inicio)); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_fim)); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('data_relatorio')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_relatorio)); ?>
	<br />
	<?php if($model->skydrive): ?>
	<b><?php echo CHtml::encode($model->getAttributeLabel('skydrive')); ?>:</b>
	<?php echo CHtml::link('<i class="icon icon-cloud" style="color: #094AB2;"></i>'
					, $model->skydrive
					, array('target'=>'_blank', 'title'=>'Skydrive')); ?> <br />
	<?php endif; ?>
</div>
</div> <!--/row-->
	<div class="row-fluid">
		<div class="span6">
			<h5>Instrumento Jurídico Fundação de Apoio</h5>
			<?php $this->renderPartial('_view_convenio', array('model'=>$model->convenio)); ?>
		</div>
		<div class="span6">
			<h5>Instrumento Jurídico Parceiro Institucional</h5>
			<?php $this->renderPartial('_view_inst_juridico', array('model'=>$model->instrumento_juridico)); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<h5>Descrição do Projeto</h5>
			<p><?php echo $model->descricao; ?></p>
		</div>
	</div>
</div>

<div class="view">
	<div class="row-fluid">
		<div class="span6">
			<h5>Coordenadores</h5>
			<b><?php echo $model->getAttributeLabel('cod_professor'); ?></b>
			<?php echo CHtml::encode($model->coordenador->nome); ?>
			<br />
			
			<b><?php echo $model->getAttributeLabel('cod_pos_grad'); ?>:</b>
			<?php if(is_object($model->vice_coordenador)):?>
				<?php echo CHtml::encode($model->vice_coordenador->nome); ?>
			<?php else:?>
			Não há vice-coordenador.
			<?php endif;?>
			<br />
			
			<b><?php echo $model->getAttributeLabel('cod_grad'); ?>:</b>
			<?php if(is_object($model->fiscal)):?>
				<?php echo CHtml::encode($model->fiscal->nome); ?>
			<?php else:?>
			Não há fiscal.
			<?php endif;?>
			<br />

			<b><?php echo $model->getAttributeLabel('cod_bolsista_responsavel'); ?>:</b>
			<?php if(is_object($model->bolsista_responsavel)):?>
				<?php echo CHtml::encode($model->bolsista_responsavel->nome); ?>
			<?php else:?>
			Não há bolsista responsável.
			<?php endif;?>
			<br />
		</div>
		<div class="span6">
			<h5>Assistentes de Projeto</h5>
			<ul class="unstyled" id="membros-ativos">
			<?php foreach($model->pessoas as $pessoa):?>
				 <li class="membro">
				 	<b><?php echo CHtml::link(CHtml::encode($pessoa->nome), array('pessoa/view', 'id'=>$pessoa->cod_pessoa)); ?></b>
				 	 <button class="set-status btn btn-small btn-primary pull-right" title="Desativar Membro" data-pess="<?php echo $pessoa->cod_pessoa?>" data-prj="<?php echo $model->cod_projeto?>" data-status="0">
				 	 	Desativar Membro
				 	 </button>
				 </li>
			<?php endforeach;?>
			</ul>	
			<h5>Assistentes Inativos</h5>
			<ul class="unstyled" id="membros-inativos">
			<?php foreach($model->pessoas_inativas as $pessoa):?>
				 <li class="membro">
				 	<b><?php echo CHtml::link(CHtml::encode($pessoa->nome), array('pessoa/view', 'id'=>$pessoa->cod_pessoa)); ?></b>
				 	 <button class="set-status btn btn-small btn-primary pull-right" title="Ativar Membro" data-pess="<?php echo $pessoa->cod_pessoa?>" data-prj="<?php echo $model->cod_projeto?>" data-status="1">
				 	 	Ativar Membro
				 	 </button>
				 </li>
			<?php endforeach;?>
			</ul>
		</div>
		
	
</div>

<?php 
$url_set = $this->createUrl('/projeto/setMembro');
Yii::app()->clientScript->registerScript("membro","
$('.set-status').hide();

$('.membro').hover(function(){
	$(this).children('.set-status').show();
	$(this).css('background-color', '#EEE');
}, function(){
	$(this).children('.set-status').hide();
	$(this).css('background-color', '#FFF');
});

$('.set-status').click(function(){
	var data = {
		cod_pessoa: $(this).attr('data-pess'),
		cod_projeto: $(this).attr('data-prj'),
		ativo: $(this).attr('data-status')
	}
	
	var container = this;

	$.post('{$url_set}', {membro: data}, function(response){
		var new_obj = $(container).parent().clone();
		$(container).parent().remove();

		if(data.ativo == '1')
			$('#membros-ativos').append(new_obj);
		else
			$('#membros-inativos').append(new_obj);
		

		$('.set-status').hide();
	})
});

");