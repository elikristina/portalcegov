<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	'Gerenciar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Equipe', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Categorias', 'url'=>array('categoria/admin')),
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
