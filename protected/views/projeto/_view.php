<div class="view">
<h1><?php echo CHtml::encode($data->t('nome')); ?></h1>
<h4><?php echo CHtml::encode($data->t('subtitulo')); ?></h4>

	<b><?php echo CHtml::encode($data->getAttributeLabel('texto')); ?>:</b>
	<?php echo CHtml::encode($data->t('texto')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_inicio')); ?>:</b>
	<?php echo CHtml::encode($data->data_inicio); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode($data->data_fim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('financiador')); ?>:</b>
	<?php echo CHtml::encode($data->t('financiador'); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->t('status')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_ajuda')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_ajuda); ?>
	<br />

</div>