<?php
/* @var $this ProjetoDespesaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Projeto Despesas',
);

$this->menu=array(
	array('label'=>'Create ProjetoDespesa', 'url'=>array('create')),
	array('label'=>'Manage ProjetoDespesa', 'url'=>array('admin')),
);
?>

<h1>Projeto Despesas</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
