<?php
$this->breadcrumbs=array(
	Yii::t('default', 'publicacoes')=>array('index'),
	Yii::t('Publicacao', 'admin'),
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> ' .Yii::t('Publicacao', 'add'), 'url'=>array('create')),
);

?>

<h2><?php echo Yii::t('Publicacao', 'admin')?></h2>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'publicacao-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'titulo',
		'autor',
		'pessoal',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
