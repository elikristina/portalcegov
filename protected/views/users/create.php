<?php
$this->breadcrumbs=array(
	'Configurações'=>array('configuracoes/index'),
	'Adicionar Usuário',
);

$this->menu=array(
	array('label'=>'Gerenciar Usuários', 'url'=>array('admin')),
);
?>

<h1>Adicionar Usuário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>