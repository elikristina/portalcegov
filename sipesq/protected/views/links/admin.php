<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Links', 'url'=>array('index')),
	array('label'=>'Adicionar Link', 'url'=>array('create')),
	array('label'=>'Gerenciar Links', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('links-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Busca Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'links-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		'link',
		'descricao',
		'tags',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
