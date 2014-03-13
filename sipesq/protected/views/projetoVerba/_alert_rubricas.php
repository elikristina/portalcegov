<?php
/**
* @var $projeto Projeto
*/

$this->breadcrumbs=array(
		'Projetos'=>array('/projeto/'),
		$model->projeto->nome => array('/projeto/view', 'p'=>'financeiro', 'id'=>$model->projeto->cod_projeto),
		'Adicionar Verba',
);

Yii::app()->clientScript->registerScript('tip', "$('.tip').tooltip({placement: 'left'})");

?>
<div class="well well-small">
	<h5>Todos os orçamentos já foram contemplados</h5>
	
	<b>Rubricas contempladas</b><br>
	<ul>
	<?php foreach($model->projeto->receitas as $rec):?>
		<?php foreach($rec->rubricas as $rub):?>
			<li class="tip" title="Verba #<?php echo $rec->cod_verba?>"><?php echo CHtml::link($rub->nome, array('/projetoVerba/view', 'id'=>$rec->cod_verba), array('class'=>'btn-link'))?></li>
		<?php endforeach;?>
	<?php endforeach;?>
	</ul>
	<div class="alert alert-info">
		Para adicionar um novo recebimento você deve adicionar antes um orçamento.
		Estes orçamentos podem ser especificados pelo link <?php echo CHtml::link('Orçamentos', array('/projeto/update/', 'id'=>$model->projeto->cod_projeto, '#'=>'orcamento'))?>.
		<br>Se você deseja aumentar o valor disponível para algum recebimento ou rubrica você deve ir até a página deste recebimento e adicionar mais desembolsos para tal.
		Nos links acima você tem acesso a estes desembolsos.
	</div>
</div>