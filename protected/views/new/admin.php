<?php
/* @var $this NewController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias / Eventos'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Notícias', 'url'=>array('index')),
	array('label'=>'<i class="icon-list"></i> Listar Eventos', 'url'=>array('events')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Notícia/Evento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('noticia-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>




<div class="row-fluid">
<div class="span12">

<h4>Gerenciar Notícias</h4>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'noticia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'titulo',
		'data_postagem',
		'autor',
		'eh_evento',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
</div>
</div>