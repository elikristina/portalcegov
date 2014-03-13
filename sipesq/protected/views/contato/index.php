<?php
$this->breadcrumbs=array(
	'Contatos'=>array('/contato/'),
);

$this->menu=array(
	array('label'=>'Adicionar Contato', 'url'=>array('create')),
	array('label'=>'Gerenciar Contatos', 'url'=>array('admin')),
);
?>

<?php Yii::app()->clientScript->registerScript('tooltips', "
$('.icon').tooltip();

");?>

<div class="row-fluid">
	<div class="span12">
		<h4>Contatos</h4>

		<?php
			 $form=$this->beginWidget('CActiveForm', array(
				'id'=>'contato-form',
				'enableAjaxValidation'=>false,
				'action'=>array('/contato/search/'),
				'method'=>'GET',
		)); ?>
			<?php echo $form->errorSummary($model); ?>

				<?php echo $form->textField($model,'nome', array('class'=>"input-medium search-query input-xxlarge", 'onchange'=>'location.href = "/sipesq/index.php/contato/search?Contato%5Bnome%5D=" + this.value', 'size'=>60, 'placeholder'=>'Digite um nome, email, etc')); ?>
				<?php echo CHtml::submitButton('Buscar', array('class'=>'btn btn-small')); ?>
			
		<?php $this->endWidget(); ?>

		<?php foreach(range('A', 'Z') as $char):?>
			<?php echo CHtml::link($char, array('/contato/index', 'l'=>$char))?>
		<?php endforeach;?><br>
		
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		 <br>

		<?php
			if(Sipesq::getPermition('acervo.contatos') >=100)
		 		echo CHtml::link('Adicionar Contato', array('/contato/create'), array('class'=>'btn btn-primary btn-small')); 
		 ?>
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',)); 
		?>
	</div>
</div>