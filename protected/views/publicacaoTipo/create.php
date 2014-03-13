<?php
$this->breadcrumbs=array(
	'Publicações'=>array('publicacao/index'),
	'Tipos'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Tipos', 'url'=>array('index')),
	
);


Yii::app()->clientScript->registerScript('tiny-mce',"
	tinyMCE.init({
		mode : 'textareas',
		theme : 'simple'
	});
			
");
?>

<h1>Adicionar Tipo</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>