<?php
$this->breadcrumbs=array(
	'Pessoa Categorias',
);

$this->menu=array(
	array('label'=>'Listar Categorias', 'url'=>array('index')),
	array('label'=>'Adicionar Categorias', 'url'=>array('create')),
);
?>

<h2>Categorias de Pessoas</h2>
<div class="view">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>