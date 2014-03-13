<?php
$this->breadcrumbs=array(
	"Sobre"=>array('/about/index'),
	$title,
);?>

<?php echo $content?>

<?php if(!Yii::app()->user->isGuest):?>
<div class="row">
<?php echo CHtml::link("Editar", 
	array("/about/updatePartners"),
	array(
		'class'=>"button",
		)
	);?>
</div>
<?php endif;?>

