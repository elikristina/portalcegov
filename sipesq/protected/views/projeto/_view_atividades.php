<h3>Atividades</h3>
<?php echo CHtml::link('Adicionar Atividade', array('/atividade/create', 'projeto'=>$model->cod_projeto), array('class'=>'tip btn btn-primary btn-small', 'title'=>"Adicionar Atividade")); ?>
	<?php if(count($model->atividades) < 1):?>
	<div class="view">Não há atividades cadastradas neste projeto</div>
	<?php endif;?>
	<?php foreach ($model->atividades as $atividade):?>
		<?php $this->renderPartial('/atividade/_view', array('data'=>$atividade));?> 
	<?php endforeach;?>