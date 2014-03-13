<?php
/* @var $this GrupoController */
/* @var $model Grupo */

$this->breadcrumbs=array(
		'Grupos'=>array('index'),
		'Adicionar Grupo',
);

$this->menu=array(
		array('label'=>'Listar Grupos', 'url'=>array('index')),
);
?>
<div class="row-fluid">
	<div class="span12">
		<h2>Adicionar Novo Grupo</h2>
		<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
	</div>
</div>
