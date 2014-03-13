<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Projetos', 'url'=>array('index')),
	array('label'=>'Criar Projeto', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('projeto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Projetos</h1>

<?php echo CHtml::link('Pesquisa Avançada','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'projeto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		'data_inicio',
		'data_fim',
		'data_relatorio',
		array(
			'class'=>'CButtonColumn',
			//'type'=>'raw',
		),
	),
)); ?>
