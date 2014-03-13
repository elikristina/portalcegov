<?php
/* @var $this NewController */
/* @var $data Noticia */

?>

<div class="row-fluid">
	<div class="span12">
		<div class="container-cegov">
			<div class="well well-small">
				<div class="media-img span1">
					<?php echo CHtml::encode($data->data_postagem); ?>
					<!-- <a class="pull-left" href="#">
						<img class="media-object" src="http://placehold.it/64x64">
					</a> -->
				</div>
				<div class="media-txt span11">
					<!-- <i class="pull-right"><?php echo CHtml::encode($data->data_postagem); ?></i><br> -->
					<h5 class="media-heading"><?php echo CHtml::link($data->t('titulo'), array('new/view', 'id'=>$data->cod_noticia), array('style'=>'padding-left:20px')); ?></h5>
				</div>
			</div>	
			<?php //echo CHtml::link(Yii::t('default','detalhes'), array('/new/view', 'id'=>$data->cod_noticia), array('class'=>'btn btn-small btn-info pull-right'));?>
			<div class="clearfix"></div>
		</div>		
	</div><!-- span12 -->
</div><!-- row-fluid -->