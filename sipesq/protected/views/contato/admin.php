<?php
$this->breadcrumbs=array(
	'Contatos'=>array('index'),
	'Gerenciar Contatos',
);

$this->menu=array(
	array('label'=>'Listar Contatos', 'url'=>array('index')),
	array('label'=>'Adicionar Contatos', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('contato-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Contatos</h1>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contato-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		'email',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
