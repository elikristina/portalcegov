<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	'Adicionar Membro',
);



$this->menu=array(
	array('label'=>'Listar Pessoas', 'url'=>array('index')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
);
?>

<h1>Adicionar Membro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>