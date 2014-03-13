<div class=" view ">
	<h4><b><?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_projeto)); ?></b></h4>
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_professor')); ?>:</b>
	<?php echo CHtml::encode($data->coordenador->nome); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_projeto')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_projeto); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($data->data_fim)); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('situacao')); ?>:</b>
	<span class="label <?php echo $data->class?>"><?php echo CHtml::encode($data->situacao_text); ?></span>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('skydrive')); ?>:</b>
	<?php $imageSkydrive = CHtml::image(Yii::app()->baseUrl .'/images/skydrive.png', 'skydrive');
		 if($data->skydrive) 
			echo CHtml::link('<i class="icon icon-cloud" style="color: #094AB2;"></i>'
					, $data->skydrive
					, array('target'=>'_blank', 'title'=>'Skydrive')); ?> <br />
	
</div>