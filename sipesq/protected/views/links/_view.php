<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_link)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->link), array('redirect', 'link'=>$data->link), array('target'=>'_blank')); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descricao')); ?>:</b>
	<?php echo CHtml::encode($data->descricao); ?>
	<br />
	<b><?php echo CHtml::encode($data->getAttributeLabel('tags')); ?>:</b>
	<?php foreach(explode(', ', $data->tags) as $tag):?>
		<?php echo CHtml::link(CHtml::encode($tag), array('/links/search', 'q'=>$tag)); ?>
	<?php endforeach;?>
	<br />


</div>