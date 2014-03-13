<?php
$this->breadcrumbs=array(
	'Contatos'=>array('index'),
	'Adicionar Contato',
);

$this->menu=array(
	array('label'=>'Listar Contatos', 'url'=>array('index')),
	array('label'=>'Gerenciar Contatos', 'url'=>array('admin')),
);
?>

<h4>Adicionar Contato</h4>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>