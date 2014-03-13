<?php
$this->breadcrumbs=array(
	'Paginas'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Adicionar Serviço', 'url'=>array('create')),
	array('label'=>'Configurações do Site', 'url'=>array('/configuracoes/index')),
);


?>

<h1>Gerenciar Serviços</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'pagina-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'titulo',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
