<?php
$this->breadcrumbs=array(
	
	'Projetos',
);

$this->menu=array(
	array('label'=>'Create Projeto', 'url'=>array('create')),
	array('label'=>'Manage Projeto', 'url'=>array('admin')),
);
?>

<h1>Projetos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/projeto/_view',
)); ?>
