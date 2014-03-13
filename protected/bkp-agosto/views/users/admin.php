<?php
$this->breadcrumbs=array(
	'Configuraçoes'=>array('/configuracoes/index'),
	'Gerenciar Usuários',
);

$this->menu=array(
	array('label'=>'Adicionar Usuário', 'url'=>array('create')),
	array('label'=>'Configurações do Site', 'url'=>array('/configuracoes/index')),
);
?>

<h1>Gerenciar Usuários</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'username',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
