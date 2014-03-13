<?php
$this->breadcrumbs=array(
	'Pessoas com Recebimentos',
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Adicionar Financeiro', 'url'=>array('pessoaFinanceiro/create')),
	array('label'=>'Gerenciar Pessoa', 'url'=>array('admin')),
);
?>

<h1>Pessoas com Recebimentos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_bolsa',
)); ?>
