<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
Yii::app()->clientScript->registerScript('date-formater',"
  		
	$(document).ready(
	function(){
	$('.date').html($.datepicker.formatDate( 'dd/mm/yy', new Date($('.date').html())));
	}
	
	);				
");

$gt = GrupoTrabalho::model()->findByPk($model->cod_gt);

$this->breadcrumbs=array(
	'Grupos de Trabalho'=>array('index'),	
	$gt->nome=>array('view', 'id'=>$gt->cod_gt),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Editar', 'url'=>array('updateProjeto', 'id'=>$model->cod_projeto)),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('deleteProjeto','id'=>$model->cod_projeto),'confirm'=>'Tem certeza que deseja deletar este projeto?')),
);

?>

<div class="view-publicacao" id="<?php echo $model->cod_projeto ?>">
		<h3><b><?php echo CHtml::encode($model->nome);?></b></h3>
		<h4><i><?php echo CHtml::encode($model->subtitulo);?></i></h4>
		
		<p><?php echo $model->texto;?></p>
		
		<p>
			<br>
			<b><?php echo CHtml::encode($model->getAttributeLabel('data_inicio')); ?>:</b>
			<span class="date"><?php echo CHtml::encode($model->data_inicio); ?></span>
			<br />
			
			<b><?php echo CHtml::encode($model->getAttributeLabel('data_fim')); ?>:</b>
			<span class="date"><?php echo CHtml::encode($model->data_fim); ?></span>
			<br />
		
			<b><?php echo CHtml::encode($model->getAttributeLabel('financiador')); ?>:</b>
			<?php echo CHtml::encode($model->financiador); ?>
			<br />
			
			<b><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>:</b>
			<?php echo CHtml::encode($model->status); ?>
			<br />
			
			<b><?php echo CHtml::encode($model->getAttributeLabel('tipo_ajuda')); ?>:</b>
			<?php echo CHtml::encode($model->tipo_ajuda); ?>
			<br />
		</p>
</div>
