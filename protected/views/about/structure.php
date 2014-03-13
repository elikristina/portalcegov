<?php
$this->breadcrumbs=array(
	Yii::t('default','sobre')=>array('/about/index'),
	$title,
);?>

<div class="row-fluid">
	<div class="span12">
		<?php echo $content?>
		
		<?php if(Yii::app()->user->name == 'admin'):?>
			<?php echo CHtml::link("Editar", 
				array("/about/updatePartners"),
				array(
					'class'=>"btn btn-small btn-primary",
					)
				);?>
		<?php endif;?>
	</div>
</div>