<div class="view-pessoa" id="<?php echo $data->cod_pessoa ?>">
	<div class="pessoa-image">
		<?php echo CHtml::image($data->imageLink, 'Imagem pessoal', array('align'=>'absmiddle')); ?>
	</div>
	
	<div class="pessoa-info">
		<p>
		<span style="font-size: 18px;"><?php echo CHtml::encode($data->nome);?></span><br>
			<?php if(isset($categoria)):?>
				<i><?php echo CHtml::encode($categoria);?></i>
				<br>
			<?php endif;?>
			<?php if(!Yii::app()->user->isGuest):?>
				<i><?php echo CHtml::encode($data->email);?></i>
			<?php endif;?>
		</p>
	</div>
</div>