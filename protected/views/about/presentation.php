<?php
$this->breadcrumbs=array(
	Yii::t('default','sobre')=>array('/about/index'),
	$title,
);?>

<?php Yii::app()->clientScript->registerScript('hover', "

$('.quad').hover(function(){
	$(this).css('background-color', '#1b3959');
}, function(){
	$(this).css('background-color', '#4e4e4e');
});

"); ?>

<div class="row-fluid">
	<div class="span12">
		<?php echo $content?>
	
	
		<?php if(Yii::app()->user->name == 'admin'):?>
			<?php echo CHtml::link("Editar", 
				array("/about/updatePresentation"),
				array(
					'class'=>"btn btn-small btn-primary",
					)
				);?>
		<?php endif;?>
	</div>
</div>


