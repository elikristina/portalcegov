<li style="font-size: 12px;" class="ui-state-default <?php echo ($data->cod_categoria_pai != null) ? "ui-state-active" : "" ?>" id="<?php echo $data->cod_categoria; ?>">
	<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
	<?php echo CHtml::encode($data->nome) ?>
	<?php if($data->cod_categoria_pai != null)
		echo " ( {$data->categoriaPai->nome} ) ";
	?> 
</li>