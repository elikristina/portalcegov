<li class="ui-state-default" id="<?php echo $data->cod_gt; ?>">
	<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
	<?php echo CHtml::encode($data->nome);?>
	<?php if(!$data->visible):?> (GT Inativo)<?php endif;?>
</li>
