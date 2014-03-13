<?php
$this->breadcrumbs=array(
	'Subscriptions'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Ver Todos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('subscription-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Subscriptions</h1>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'subscription-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'titulo',
		'validade',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
