<?php 

Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl ."/js/charts.js", CClientScript::POS_END);

Yii::app()->clientScript->registerScript('table_financeiro',"

$('.atv-desc').each(function(){

	$(this).html($(this).text());

});

")?>

<!-- INFORMACOES GERAIS -->
<div id="relatorio-header">
	<?php //echo CHtml::image('/sipesq/images/logo_ufrgs.png', 'Logo UFRGS', array('class'=>'logo', 'width'=>'150')); ?>
	<?php //echo CHtml::image('/sipesq/images/logo_cegov.png', 'Logo CEGOV', array('class'=>'logo','width'=>'140')); ?>
	<?php echo CHtml::encode($model->nome, array('id'=>'title')); ?>	
	<br />
</div>

<div class="relatorio-section">
	<span class="relatorio-number">1</span>Informações Gerais
</div>

<br />

<div class="relatorio-text">	
		<div class="view view-atividade">
			<div class="atv-nome">
		Instrumento Jurídico Fundação de Apoio
	</div>
		<?php $this->renderPartial('/projeto/relatorio/_convenio', array('model'=>$model->convenio)); ?>
	</div>
	<div class="view view-atividade">
			<div class="atv-nome">
		Instrumento Jurídico Parceiro Institucional
	</div>
		<?php $this->renderPartial('/projeto/relatorio/_inst_juridico', array('model'=>$model->instrumento_juridico)); ?>
	</div>
</div>
<br />
<br />

<div class="relatorio-section">
	<span class="relatorio-number">2</span>Equipe
</div>
<br />
<div class="relatorio-text">
	<div class="row-fluid">
		<div class="span2" id="atv-section">
			<?php echo $model->getAttributeLabel('cod_professor'); ?><span class="print">:</span>
		</div>
		<div class="span10" id="atv-text">
			<?php echo CHtml::encode($model->coordenador->nome); ?>
		</div>
	</div>
	<div class="row-fluid">
		<div class="span2" id="atv-section">
			<?php echo CHtml::encode("Equipe"); ?> (<?php echo count($model->pessoas); ?>)<span class="print">:</span>
		</div>
		<div class="span10" id="atv-text">
			<?php foreach($model->pessoas as $pessoa) echo  $pessoa->nome. "<br />" ?>
		</div>
	</div>
</div>

<br />
<br />

<div class="relatorio-section">
	<span class="relatorio-number">3</span>Descrição
</div>
<br />
<div class="relatorio-text" id="atv-text">
	<?php echo $model->descricao; ?>
</div>

<br />
<br />

<div class="relatorio-section section-break">
	<span class="relatorio-number">4</span>Atividades
</div>
<br />
<div class="relatorio-text">
	<?php $this->renderPartial('relatorio/_atividades', array('model'=>$model))?>	
</div>

<br />
<br />

<div class="relatorio-section section-break">
	<span class="relatorio-number">5</span>Financeiro
</div>

<div class="relatorio-text" >
	<?php $this->renderPartial('relatorio/_financeiro_relatorio', array('model'=>$model))?>	
</div>

