<div class="view-pessoa-min" id="<?php echo $data->cod_pessoa ?>">
	<div class="pessoa-image-min">
		<?php echo CHtml::image($data->imageLink, 'Imagem pessoal'); ?>
	</div>
	<div class="pessoa-min">
		<br>
		<p><?php echo CHtml::link($data->nome, array('/pessoa/view', 'id'=>$data->cod_pessoa));?></p>
	</div>
</div>
<div class="clearfix"></div>