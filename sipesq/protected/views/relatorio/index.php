<?php
$this->breadcrumbs=array(
	'Relatórios',
);
$this->menu=array(
	array('label'=>'Relatório de Atividades', 'url'=>array('atividade')),
	array('label'=>'Relatório de Projetos', 'url'=>array('projeto')),
	array('label'=>'Relatório de Pessoas', 'url'=>array('pessoas')),
);
?>
<h1>Selecione um relatório.</h1>
<div class="view">
	<b><?php echo CHtml::link(CHtml::encode('Relatório de Atividades'), array('/relatorio/atividade')); ?></b><br>
	<b><?php echo CHtml::link(CHtml::encode('Relatório dos Projetos'), array('/relatorio/projeto')); ?></b>
</div>

