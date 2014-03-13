<?php
/* @var $this PatrimonioController */
/* @var $model Patrimonio */

$this->breadcrumbs=array(
	'Patrimonios'=>array('index'),
	'Gerencia de Patrimônios',
);

$this->menu=array(
		array('label'=>'<i class="icon icon-list"></i> Listar Patrimônios', 'url'=>array('index'), 'visible'=>Sipesq::isSupport()),
		array('label'=>'<i class="icon icon-list-alt"></i> Gerenciar Patrimônios', 'url'=>array('admin'), 'visible'=>Sipesq::isSupport()),
);

?>

<h2>Gerencia de Patrimônios</h2>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'patrimonio-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		'nro_patrimonio',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
