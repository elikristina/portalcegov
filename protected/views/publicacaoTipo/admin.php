<?php
$this->breadcrumbs=array(
	'Publicacao Tipos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Tipos', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Tipo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('publicacao-tipo-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Gerenciar Tipos de Publicação</h3>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'publicacao-tipo-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cod_tipo',
		'nome',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
