<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_projeto),
	'Editar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Projetos', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Criar Novo Projeto', 'url'=>array('create')),
	array('label'=>'<i class="icon-zoom-in"></i> Ver este Projeto', 'url'=>array('view', 'id'=>$model->cod_projeto)),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Projetos', 'url'=>array('admin')),
);
?>

<h3> <?php echo $model->nome; ?></h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>