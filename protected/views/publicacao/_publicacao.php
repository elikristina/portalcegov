<div class="span3" id="<?php echo $data->cod_publicacao ?>">
	<h4><b><?php echo CHtml::encode($data->titulo);?></b></h4>
		<?php echo CHtml::image($data->imageLink)?>
			<?php echo $data->descricao;?>
			<b><?php echo CHtml::encode($data->getAttributeLabel('autor')); ?>:</b>
			<?php echo CHtml::encode($data->autor); ?>
			<br />
		
			<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
			<?php echo CHtml::encode($data->ano); ?>
			<br />
</div>
