<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_pessoa),
	'Editar',
);

$this->menu=array(
	array('label'=>'Listar Pessoas', 'url'=>array('index')),
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('select',"

	$('input').click(function(){
		$(this).select();
	}	
    );
  		
");
?>




<div style="float: left">

<h1><?php echo $model->nome; ?></h1>
</div>

<div style="float: right;">
	<?php echo CHtml::image($model->imageLink, 'Imagem pessoal', array('height'=>150, 'width'=>150)); ?>
</div>

<div style="clear: both;">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>