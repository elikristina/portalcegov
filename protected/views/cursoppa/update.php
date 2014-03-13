<?php
$this->breadcrumbs=array(
	'Atlases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Atlas', 'url'=>array('index')),
	array('label'=>'Create Atlas', 'url'=>array('create')),
	array('label'=>'View Atlas', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Atlas', 'url'=>array('admin')),
);
?>

<h1>Update Atlas <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>