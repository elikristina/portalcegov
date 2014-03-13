<?php
$gt = GrupoTrabalho::model()->findByPk($_GET['id']);

$this->breadcrumbs=array(
	'Grupos de Trabalho'=>array('index'),	
	$gt->nome=>array('view', 'id'=>$gt->cod_gt),
	'Gerenciar Projetos',
);

$this->menu=array(
	array('label'=>'Adicionar Projeto', 'url'=>array('createProjeto', 'id'=>$model->cod_gt)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('projeto-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'projeto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'nome',
		'data_inicio',
		'data_fim',
		array(
			'class'=>'CButtonColumn',
			'viewButtonUrl'=>'Yii::app()->createUrl("/gt/viewProjeto", array("id" => $data->cod_projeto))',
      		'deleteButtonUrl'=>'Yii::app()->createUrl("/gt/deleteProjeto", array("id" => $data->cod_projeto))',
      		'updateButtonUrl'=>'Yii::app()->createUrl("/gt/updateProjeto", array("id" => $data->cod_projeto))',
		),
	),
)); ?>
