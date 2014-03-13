<?php Yii::app()->clientScript->registerScript('foco_busca',"
			
			$(document).ready( 
			 function(){
			 $('#Livro_titulo').focus();
			 }
			
			);
			
			");
?>
<?php
$this->breadcrumbs=array(
	'Livros',
);

$this->menu=array(
	array('label'=>'Adicionar Livro', 'url'=>array('create')),
	array('label'=>'Gerenciar Livros', 'url'=>array('admin')),
);
?>

<h1>Livros</h1>
<!--  COLOCAR TAGS E BUSCA POR TAGS!!!!! -->
<!--  COLOCAR TAGS E BUSCA POR TAGS!!!!! -->
<!--  COLOCAR TAGS E BUSCA POR TAGS!!!!! -->
<!--  COLOCAR TAGS E BUSCA POR TAGS!!!!! -->
<!--  COLOCAR TAGS E BUSCA POR TAGS!!!!! -->
<?php
	 $form=$this->beginWidget('CActiveForm', array(
		'id'=>'livro-form',
		'enableAjaxValidation'=>false,
		'action'=>array('/livro/search/'),
		'method'=>'GET',
	 'htmlOptions'=>array('class'=>'form-search')
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textField($model,'titulo', array('onchange'=>'location.href = "/sipesq/index.php/livro/search?Livro%5Btitulo%5D=" + this.value', 'size'=>60, 'class'=>'input-medium search-query')); ?>
		<?php echo $form->error($model,'titulo'); ?>
		<?php echo CHtml::submitButton('Buscar', array('class'=>"btn btn-primary")); ?>
	
<?php $this->endWidget(); ?>
<br>
<?php echo CHtml::link('Ver Empréstimos', array('emprestimos'));?>&nbsp; :: &nbsp;
<?php echo CHtml::link('Histórico de Empréstimos', array('historico'));?>&nbsp; :: &nbsp;
<?php echo CHtml::link('Listar Todos', array('all'));?>
