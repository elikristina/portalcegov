<?php
$this->breadcrumbs=array(
	'Livros'=>array('index'),
	'Gerenciar Livros',
);

$this->menu=array(
	array('label'=>'Listar Livros', 'url'=>array('index')),
	array('label'=>'Adicionar Livro', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('livro-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Gerenciar Livros</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'livro-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'cod_livro',
		'autor',
		'ano',
		'titulo',
		'subtitulo',
		'editora',
		/*
		'cidade_publicacao',
		'nro_edicao',
		'nro_patrimonio',
		'cod_projeto',
		'valor',
		'local_compra',
		'nro_nota_fiscal',
		'isbn',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
