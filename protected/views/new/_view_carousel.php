<?php
/* @var $this NewController */
/* @var $data Noticia */

?>


<div class="row-fluid">
<div class="span12">
	<!-- <a href=""></a>
	<img src="<?php echo Yii::app()->baseUrl?>/img/img_cegov.png" alt="" width="1024"; ?>
	<div class="carousel-caption">
	
	</div> --> 
	
	
	<div class="carousel-text">
		<?php echo CHtml::image($data->imageLink, 'Imagem Carrossel'); ?>
		<div class="carousel-caption">
			<?php echo CHtml::link($data->t('titulo'), array('/new/view', 'id'=>$data->cod_noticia), array('class'=>'carousel-caption-p')); ?>
		</div>
	<?php //echo $data->t('texto') ?>
	


	<br />
	<!-- <div class="clearfix"></div>
	<?php if(!Yii::app()->user->isGuest):?>
		<br>
		<i class="pull-right">
		<?php if($data->eh_evento):?>
		Evento cadastrado por <b><?php echo CHtml::encode($data->autor); ?></b>
		<?php else:?>
		Notícia cadastrada por <b><?php echo CHtml::encode($data->autor); ?></b>
		<?php endif;?>
		</i>
		<div class="clearfix"></div>
	<?php endif;?>-->
	</div>
	
	<?php //echo CHtml::link(Yii::t('default','detalhes'), array('/new/view', 'id'=>$data->cod_noticia), array('class'=>'button pull-right'));?>
	

</div><!-- span12 -->
</div><!-- row-fluid -->