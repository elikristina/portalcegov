<?php
$this->breadcrumbs=array(
	'Paginas',
);

?>

<h1>Paginas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
