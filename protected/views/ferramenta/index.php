<?php
/* @var $this FerramentaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ferramentas',
);

$this->menu=array(
	array('label'=>'Create Ferramenta', 'url'=>array('create')),
	array('label'=>'Manage Ferramenta', 'url'=>array('admin')),
);
?>

<h3>Ferramentas de Apoio</h3>

<div class="container-cegov">



	<div class="content">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
		)); ?>
	</div>
</div>
