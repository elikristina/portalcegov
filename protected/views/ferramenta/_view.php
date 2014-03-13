<?php
/* @var $this FerramentaController */
/* @var $data Ferramenta */
?>

<div class="span3">
	<div class="ferramenta-imagem">
		<?php echo CHtml::link(CHtml::image($data->imageLink, 'Imagem', array('class'=>'ferramenta-imagem-v')), $data->link); ?>
	</div>
	<br />
	<div class="ferramenta-conteudo">
		<h3><?php echo CHtml::encode($data->nome_abreviado); ?></h3>
		<h5><?php echo CHtml::encode($data->nome_completo); ?></h5>
		<?php //echo CHtml::encode($data->texto); ?>
	</div>

</div>

</br>