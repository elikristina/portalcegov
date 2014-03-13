<?php
$gt = GrupoTrabalho::model()->findByPk($model->cod_gt);
$this->breadcrumbs=array(
	$gt->nome=>array('view', 'id'=>$gt->cod_gt),
	'Projetos'=>array('projetos', 'id'=>$model->cod_gt),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Listar Projetos', 'url'=>array('projetos', 'id'=>$model->cod_gt)),
	array('label'=>'Gerenciar Projetos', 'url'=>array('adminProjeto', 'id'=>$model->cod_gt)),
);
?>

<h2> Adicionar Projeto</h2>

<?php echo $this->renderPartial('/projeto/_form', array('model'=>$model)); ?>