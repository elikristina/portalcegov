<div class="view-pub " id="<?php echo $data->cod_publicacao ?>">

	<div class="span10 view-pub-information">
	<h4><b><?php echo CHtml::encode($data->titulo);?></b></h4>
		<div class="view-pub-description">
			<?php echo $data->descricao;?>
		</div>
			<b><?php echo CHtml::encode($data->getAttributeLabel('autor')); ?>:</b>
			<?php echo CHtml::encode($data->autor); ?>
			<br />
		
			<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
			<?php echo CHtml::encode($data->ano); ?>
			<br />
	</div>
	<div class="span2 view-pub-image">
		<?php echo CHtml::image($data->imageLink)?>
	</div>
	<div style="clear: both;"></div>
</div>
