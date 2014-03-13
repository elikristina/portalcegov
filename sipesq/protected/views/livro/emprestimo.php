<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'emprestimo-livro-emprestimo-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
	<?php if($model->livro->estaEmprestado()):?>
	 	<h4>Devolução do livro: <b><?php echo CHtml::encode($model->livro->titulo);?></b></h4>
		<?php echo CHtml::submitButton('Devolver', array('submit'=>array('devolucao','id'=>$model->cod_livro),'confirm'=>'Deseja devolver este livro?')); ?>
	<?php else:?>
		
		<h4>Empréstimo do livro: <b><?php echo CHtml::encode($model->livro->titulo);?></b></h4>
	
		<p class="note">Escolha a pessoa.</p>
	
		<div class="row">
			<?php  echo $form->dropDownList($model,'cod_pessoa',CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome') ); ?>
			<?php echo $form->error($model,'cod_pessoa'); ?>
		</div>
	
	
		<div class="row buttons">
			<?php echo CHtml::submitButton('Emprestar'); ?>
			<?php echo CHtml::submitButton('Cancelar', array('submit'=>array('view','id'=>$model->cod_livro))); ?>
		</div>
	<?php endif;?>

	

<?php $this->endWidget(); ?>

</div><!-- form -->