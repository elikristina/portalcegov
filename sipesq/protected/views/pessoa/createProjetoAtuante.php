<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('index'),
	'Adicionar',
);

$this->menu=array(
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
);
?>

<h1>Adicionar Projeto Atuante</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pessoa-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php $projetos = Projeto::model()->findAll(array('order'=>'nome'));?>
		<?php  echo $form->dropDownList($model,'cod_projeto',array("NULL"=>"Selecione um Projeto") + CHtml::listData($projetos, 'cod_projeto', 'nome') ); ?>
		<?php echo $form->error($model,'cod_projeto'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
