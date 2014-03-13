<?php
$this->breadcrumbs=array(
	'Tipos de Publicação'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Listar Tipos', 'url'=>array('index')),
	array('label'=>'Adicionar', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('tiny-mce',"
	tinyMCE.init({
		mode : 'textareas',
		theme : 'simple'
	});
			
");
?>

<h1><?php echo $model->nome; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>