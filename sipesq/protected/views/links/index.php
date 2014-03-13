<?php
$this->breadcrumbs=array(
	'Links'=>array('index'),
);

$this->menu=array(
	array('label'=>'Listar Links', 'url'=>array('index')),
	array('label'=>'Adicionar Link', 'url'=>array('create')),
	array('label'=>'Gerenciar Links', 'url'=>array('admin')),
);
?>

<h1>Links</h1>

<?php
	 $form=$this->beginWidget('CActiveForm', array(
		'id'=>'links-form',
		'enableAjaxValidation'=>false,
		'action'=>array('/links/search/'),
		'method'=>'GET',
)); ?>

	<?php echo $form->errorSummary($model); ?>

		<?php //echo $form->textField($model,'nome'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
   		 'name'=>'Links[nome]',
    	 'source'=>Links::toArray(),
		 'value'=>$model->nome,
		));
		?>
		
		<?php echo $form->error($model,'nome'); ?>
		<?php echo CHtml::submitButton('Buscar'); ?>
		<br><br><?php echo CHtml::link('Ver Todos', array('index'))?><br>
	
<?php $this->endWidget(); ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
