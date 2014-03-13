<?php
$this->breadcrumbs=array(
	'Atividades'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Atividades', 'url'=>array('index')),
	array('label'=>'Adicionar Atividade', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('atividade-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Atividades</h1>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'atividade-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome_atividade',
		'data_inicio',
		'data_fim',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
