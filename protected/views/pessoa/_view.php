<div class="view">
	<?php echo CHtml::image($data->imageLink, 'Imagem pessoal', array('height'=>30, 'width'=>30)); ?>
	<?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_pessoa)); ?>
</div>