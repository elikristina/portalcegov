<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */

$this->breadcrumbs=array(
	'Projeto Despesas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ProjetoDespesa', 'url'=>array('index')),
	array('label'=>'Create ProjetoDespesa', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('projeto-despesa-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Projeto Despesas</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'projeto-despesa-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cod_despesa',
		'cod_rubrica',
		'valor',
		'comprador',
		'data_compra',
		'cod_projeto',
		/*
		'documento',
		'descricao',
		'data_inclusao',
		'cod_criador',
		'data_edicao',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
