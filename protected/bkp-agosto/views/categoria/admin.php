<?php
$this->breadcrumbs=array(
	'Categorias'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Gerenciar Equipe', 'url'=>array('pessoa/admin')),
	array('label'=>'Adicionar Categoria', 'url'=>array('create')),
);


?>

<h1>Gerenciar Categorias</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'categoria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
