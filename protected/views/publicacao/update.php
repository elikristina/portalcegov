<?php

//Seta o título para o breadCrumb - ele terá no máximo 40 caracteres
$tituloBrd = substr($model->titulo, 0, 40);
if(count_chars($model->titulo) > 40){
	$tituloBrd .= '...';
} 

$this->breadcrumbs=array(
	Yii::t('default', 'publicacoes')=>array('index'),
	$tituloBrd=>array('view','id'=>$model->cod_publicacao),
	Yii::t('default', 'editar'),
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> ' .Yii::t('Publicacao', 'add'), 'url'=>array('create')),
	array('label'=>'<i class="icon-info-sign"></i> ' .Yii::t('Publicacao', 'view'), 'url'=>array('view', 'id'=>$model->cod_publicacao)),
	array('label'=>'<i class="icon-tasks"></i> ' .Yii::t('Publicacao', 'admin'), 'url'=>array('admin')),
);

Yii::app()->clientScript->registerScript('tiny-mce',"
	tinyMCE.init({
		mode : 'textareas',
		theme : 'simple',
		width: '500',
        height: '150'
	});
			
");
?>

<h4> <?php echo $model->titulo; ?></h4>
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>