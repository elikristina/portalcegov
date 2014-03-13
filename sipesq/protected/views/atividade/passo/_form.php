<div class="form" style="background: #CCCCCC; padding: 5px;">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'passo-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textField($model,'descricao', array('size'=>'65', 'placeholder'=>"Descrição")); ?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'cod_pessoa'); ?>
		<?php $listDataPessoas = CHtml::listData(Pessoa::model()->with('categoria')->findAll(array('order'=>'equipe_atual DESC, t.nome')), 'cod_pessoa', 'nome', 'categoria.nome');?>
		<?php  echo $form->dropDownList($model,'cod_pessoa', $listDataPessoas, array('prompt'=>"Selecione uma Pessoa")); ?>
		<?php echo $form->error($model,'cod_pessoa'); ?>
	</div>	
	

	<div class="input buttons">
		<?php //echo CHtml::submitButton('Submit'); ?>
			<?php echo CHtml::ajaxLink('Adicionar',$this->createUrl('createPasso', array('id'=>$model->cod_atividade)),array(
       // 'onclick'=>'$("#passoDialog").dialog("open"); return false;',
        'update'=>'#passoDialog'
        ),array('id'=>'showPassoDialog'));?>
        
		<?php echo CHtml::ajaxLink('Teste', '#',array('id'=>'addPasso', 'class'=>'button') )?>
		
		   <?php echo CHtml::ajaxSubmitButton('Adicionar',CHtml::normalizeUrl(array('atividade/createPasso')),
		   		array('update'=>"#passos-holder",),array('class'=>'btn btn-small', 'id'=>'closePassoDialog')); ?>
		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->