<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	'Adicionar Membro',
);



$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Pessoas', 'url'=>array('index')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Pessoas', 'url'=>array('admin')),
);
?>

<div class="row-fluid">
<div class="span10">
<h3>Adicionar Membro</h3>
<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'endereco_res'=>$endereco_res)); ?>
</div>
</div>
