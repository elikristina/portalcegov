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
	Yii::t('default', 'gts')=>array('/gts/index'),	
	$gt->t('nome')=>array('/gt/view', 'id'=>$gt->cod_gt),
	$model->t('nome'),
);

if (Yii::app()->user->name == 'admin') {
$this->menu=array(
	array('label'=>'<i class="icon-pencil"></i> ' .Yii::t('default', 'editar'), 'url'=>array('/projeto/update', 'id'=>$model->cod_projeto)),
	array('label'=>'<i class="icon-trash"></i> ' .Yii::t('default', 'excluir'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('/projeto/delete','id'=>$model->cod_projeto),'confirm'=>'Tem certeza que deseja deletar este projeto?')),
);
}

?>

<div class="view-publicacao" id="<?php echo $model->cod_projeto ?>">
		<h4><b><?php echo CHtml::encode($model->t('nome'));?></b></h4>
		<h4><i><?php echo CHtml::encode($model->t('subtitulo'));?></i></h4>
		
		<p><?php echo $model->t('texto');?></p>
		
		<p>
			
			<!-- <b><?php echo CHtml::encode($model->getAttributeLabel('data_inicio')); ?>:</b>
			<span class="date"><?php echo CHtml::encode($model->data_inicio); ?></span>
			<br />
			
			<b><?php echo CHtml::encode($model->getAttributeLabel('data_fim')); ?>:</b>
			<span class="date"><?php echo CHtml::encode($model->data_fim); ?></span>
			<br /> -->
		
			<b><?php echo CHtml::encode($model->getAttributeLabel('financiador')); ?>:</b>
			<?php echo CHtml::encode($model->t('financiador')); ?>
			<br />
			
			<b><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>:</b>
			<?php echo CHtml::encode($model->t('status')); ?>
			<br />
			
			<b><?php if (($model->tipo_ajuda)!=NULL) {
				echo CHtml::encode($model->getAttributeLabel('tipo_ajuda')).":";
			} ?></b>
			<?php if (($model->tipo_ajuda)!=NULL) {
				echo CHtml::encode($model->tipo_ajuda);
			} ?>
			<br />

		</p>
</div>
