<h4 class="gt-item" id="h4"><a href="#"><?php echo CHtml::encode($data->t('nome'));?></a></h4>
	<div id="div-filho">
		<p>
		<b><?php echo CHtml::encode($data->getAttributeLabel('cod_coordenador')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->coordenador->nome), array('/pessoa/view', 'id'=>$data->coordenador->cod_pessoa)	); ?>
		<br />
		<?php if(isset($data->pos_responsavel)):?>
		<b><?php echo CHtml::encode($data->getAttributeLabel('cod_pos_responsavel')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->pos_responsavel->nome), array('/pessoa/view', 'id'=>$data->pos_responsavel->cod_pessoa)	); ?>
		<br />
		<?php endif;?>
		</p>
		<?php echo $data->t('apresentacao'); ?>
		<br>
		<?php echo CHtml::link(Yii::t('GrupoTrabalho', 'detalhes'),array('view', 'id'=>$data->cod_gt),array('class'=>"btn btn-small btn-info",));?>
		<br />
	</div>
