
<?php
$this->breadcrumbs=array(
	$title,
);?>

<?php echo $content?>


<?php if(!Yii::app()->user->isGuest):?>
<div>
<?php echo CHtml::link("Editar", 
	array("/site/update"),
	array(
		'class'=>"btn btn-small btn-primary",
		)
	);?>
</div>
<?php endif;?>

