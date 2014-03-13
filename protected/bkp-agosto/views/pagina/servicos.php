<?php
$this->breadcrumbs=array(
	'Serviços',
);

?>

<h1>Serviços</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
