<?php
$this->breadcrumbs=array(
	'Atlas',
);

$this->menu=array(
	array('label'=>'Adicionar Item', 'url'=>array('create')),
	array('label'=>'Gerenciar Itens', 'url'=>array('admin')),
);


Yii::app()->clientScript->registerScriptFile("http://maps.google.com/maps/api/js?sensor=true");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/atlas.js");
Yii::app()->clientScript->registerScript('google-maps', "
	//Inicializa mapa
	initialize('".$this->createUrl('/atlas/indexJson')."');
	//Registra listeners
	registerViewListeners();
	//fetchMarkers();
");

?>

<h1>Atlas de Segurança Internacional</h1>
<br>
<label><b>Bucar Local</b></label>
<?php echo CHtml::textField('query','', array('size'=>100, 'id'=>'query-form')); ?>
<?php echo CHtml::button('Buscar', array('size'=>100, 'id'=>'query')); ?>
<div class="view" id="map_canvas" style="height: 450px;"></div>
<?php if(!Yii::app()->user->isGuest):?>
	<?php echo CHtml::link('Adicionar Item', array('/atlas/create')); ?> <b>::</b> 
	<?php echo CHtml::link('Gerenciar Itens', array('/atlas/admin')); ?>
<?php endif;?>
