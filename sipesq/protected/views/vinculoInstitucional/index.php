<?php
$this->breadcrumbs=array(
	'Instituições',
);

$this->menu=array(
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h1>Instituições</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
