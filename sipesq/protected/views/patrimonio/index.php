<?php
/* @var $this PatrimonioController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Patrimonios',
);

$this->menu=array(
	array('label'=>'<i class="icon icon-list-alt"></i> Gerenciar Patrimônios', 'url'=>array('admin'), 'visible'=>Sipesq::isSupport()),
);
?>

<h1>Patrimônios</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
