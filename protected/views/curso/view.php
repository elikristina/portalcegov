<?php
$this->breadcrumbs=array(
	'Curso'=>array('index'),
);

$this->menu=array(
	array('label'=>'List Atlas', 'url'=>array('index')),
	array('label'=>'Create Atlas', 'url'=>array('create')),
	array('label'=>'Update Atlas', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Atlas', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Atlas', 'url'=>array('admin')),
);
?>
