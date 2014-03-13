<?php
/* @var $this NewController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	Yii::t('default', 'noticias')=>array('index'),
	$model->t('titulo'),
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Notícias', 'url'=>array('index')),
	array('label'=>'<i class="icon-list"></i> Listar Eventos', 'url'=>array('events')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Notícias/Eventos', 'url'=>array('admin')),
);
?>

<h2>Adicionar Notícia</h2>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>