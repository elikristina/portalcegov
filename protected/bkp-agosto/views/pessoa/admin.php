<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'Listar Equipe', 'url'=>array('index')),
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('categoria/admin')),
);
?>

<h1>Gerenciar Equipe</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pessoa-grid',
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
