<?php 
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jquery.tokeninput.js');
Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl .'/css/token/token-input.css');
Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl .'/css/token/token-input-facebook.css');

$url_tokens = Yii::app()->createUrl('/pessoa/json');
Yii::app()->clientScript->registerScript('token_input_projeto',"
	
	prePop = JSON.parse($('#Projeto_pessoas').val());
	
	$('#Projeto_pessoas').tokenInput('{$url_tokens}',{
			searchingText: 'Buscando'
		,	hintText: 'Digite um nome'
		,	noResultsText: 'Resultado não encontrado'
		,	preventDuplicates: true
		,	prePopulate: (prePop.length > 0) ? prePop : null
		,	tokenValue: 'id'
		,	tokenDelimiter: ','
	});
");

$listDataPessoas = CHtml::listData(Pessoa::model()->with('categoria')->findAll(array('order'=>'equipe_atual DESC, t.nome')), 'cod_pessoa', 'nome', 'categoria.nome');

?>

<fieldset><legend>Responsáveis e Participantes</legend>
		<div class="control-group">
		<?php echo $form->labelEx($model,'cod_professor', array('class'=>'control-label'));?>
		<div class="controls"><?php echo $form->dropDownList($model,'cod_professor', $listDataPessoas, array('prompt'=>"Selecione uma pessoa", 'class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'cod_professor'); ?>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'cod_pos_grad', array('class'=>'control-label'));?>
		<div class="controls"><?php  echo $form->dropDownList($model,'cod_pos_grad', $listDataPessoas, array('prompt'=>"Selecione uma pessoa", 'class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'cod_pos_grad'); ?>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'cod_grad', array('class'=>'control-label'));?>
		<div class="controls"><?php  echo $form->dropDownList($model,'cod_grad', $listDataPessoas, array('prompt'=>"Selecione uma pessoa", 'class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'cod_grad'); ?>
	</div>

	<div class="control-group">
		<?php echo $form->labelEx($model,'cod_bolsista_responsavel', array('class'=>'control-label'));?>
		<div class="controls"><?php  echo $form->dropDownList($model,'cod_bolsista_responsavel', $listDataPessoas, array('prompt'=>"Selecione uma pessoa", 'class'=>'input-xxlarge')); ?></div>
		<?php echo $form->error($model,'cod_bolsista_responsavel'); ?>
	</div>
	
	<div class="control-group">
		<?php echo $form->labelEx($model,'pessoas', array('class'=>'control-label')); ?>
		<div class="controls"><?php echo CHtml::textField('Projeto[pessoas]', Sipesq::listDataToken($model->pessoas, 'cod_pessoa', 'nome'), array('id'=>'Projeto_pessoas')); ?></div>
		<?php echo $form->error($model,'pessoas'); ?>
	</div>
</fieldset>