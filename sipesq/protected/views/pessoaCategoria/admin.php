<?php
$this->breadcrumbs=array(
	'Categorias de Pessoas'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar Categoria', 'url'=>array('create')),
);


?>

<h4>Gerenciar Categorias</h4>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pessoa-categoria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
