<?php
$this->breadcrumbs=array(
	$title,
);?>

<?php echo $content?>

<?php if(!Yii::app()->user->isGuest):?>
<div class="row">
<?php echo CHtml::link("Editar", 
	array("/site/update"),
	array(
		'class'=>"button",
		)
	);?>
</div>
<?php endif;?>

