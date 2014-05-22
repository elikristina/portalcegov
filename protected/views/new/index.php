<?php
/* @var $this NewController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	Yii::t('default', 'noticias'),
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-plus"></i> Adicionar Notícia/Evento', 'url'=>array('create')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Notícias/Eventos', 'url'=>array('admin')),
	);
}
?>

<h2><?php echo Yii::t('default','noticias')?></h2>

<div class="container-cegov">

	<div class="media">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view', 
		)); ?>
	</div>

</div>
