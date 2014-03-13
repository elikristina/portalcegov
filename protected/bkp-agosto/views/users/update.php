<?php
$this->breadcrumbs=array(
	'Configurações'=>array('configuracoes/index'),
	'Gerenciar Usuários' => array('users/admin'),
	$model->username,
);

$this->menu=array(
	array('label'=>'Gerenciar Usuários', 'url'=>array('admin')),
);
?>

<h1>Editar Usuário</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>