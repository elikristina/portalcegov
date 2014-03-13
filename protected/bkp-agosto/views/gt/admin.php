<?php
$this->breadcrumbs=array(
	'Grupos de Trabalho'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Grupos', 'url'=>array('index')),
	array('label'=>'Adicionar Grupo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('grupo-trabalho-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h4>Gerenciar Grupos de Trabalho</h4>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grupo-trabalho-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
