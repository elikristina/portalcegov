<?php
$this->breadcrumbs=array(
	'Publicações'=>array('publicacao/index'),
	'Tipos',
);

$this->menu=array(
	array('label'=>'Adicionar Tipo', 'url'=>array('create')),
);
?>

<h3>Tipos de Publicações</h3>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
