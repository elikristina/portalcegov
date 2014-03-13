<?php
$this->breadcrumbs=array(
	'Categorias de Atividades'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('atividade-categoria-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Gerenciar Categorias</h3>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'atividade-categoria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'categoriaPai.nome',
		'nome',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
