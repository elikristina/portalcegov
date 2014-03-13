<?php
$this->breadcrumbs=array(
	'Usuários',
);

$this->menu=array(
	array('label'=>'Criar Usuário', 'url'=>array('create')),
	array('label'=>'Gerenciar Usuários', 'url'=>array('admin')),
);
?>

<h1>Usuários</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
