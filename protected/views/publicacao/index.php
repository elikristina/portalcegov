<?php
$this->breadcrumbs=array(
	Yii::t('default', 'publicacoes')=>array('/publicacao/index'),
);

if(isset($_GET['t'])){
	
	$this->breadcrumbs = array_merge($this->breadcrumbs, array(PublicacaoTipo::model()->findByPk($_GET['t'])->nome));
}

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-plus"></i> ' .Yii::t('Publicacao', 'add'), 'url'=>array('create')),
		array('label'=>'<i class="icon-tasks"></i> ' .Yii::t('Publicacao', 'admin'), 'url'=>array('admin')),
		array('label'=>'<i class="icon-list"></i> ' .Yii::t('Publicacao', 'types'), 'url'=>array('/publicacaoTipo/index')),
	);
}

$url = $this->createUrl("/publicacao/view");
Yii::app()->clientScript->registerScript('view-pub',"
	$('.view-pub').click(function(){
		location.href = '{$url}' + '/' +  $(this).attr('id');
	});
	
	$('.view-pub').hover(
		function(){
		$('.view-pub-buttons').show();
	},
	
		function(){
		$('.view-pub-buttons').show();
	}
		
	);
	
	
");
?>

<div class="container-pub">
<h3><?php echo Yii::t('default', 'publicacoes');?> <?php echo isset($_GET["t"])? " > " .PublicacaoTipo::model()->findByPk($_GET['t'])->t('nome') : ""?></h3>


<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_pub',
	//'itemsCssClass'=>"container-pub",
)); ?>
</div>
