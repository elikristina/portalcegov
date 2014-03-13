<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	$model->nome=>array('view','id'=>$model->cod_pessoa),
	'Editar',
);

$this->menu=array(
	array('label'=>'<i class="icon-list"></i> Listar Pessoas', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
);


Yii::app()->clientScript->registerScript('select',"

	$('input').click(function(){
		$(this).select();
	}	
    );
  		
");
?>

<div class="row-fluid">
<div class="span10">
<div class="pull-left">

<h1><?php echo $model->nome; ?></h1>
</div>

<div class="pull-right">
	<?php echo CHtml::image($model->imageLink, 'Imagem pessoal', array('height'=>150, 'width'=>150)); ?>
</div>

<div class="clearfix"></div>
<?php echo $this->renderPartial('_form', array('model'=>$model, 'endereco_res'=>$endereco_res)); ?>



</div>
</div>
