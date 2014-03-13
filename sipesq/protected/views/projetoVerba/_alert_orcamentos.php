<?php
/**
* @var $projeto Projeto
*/

$this->breadcrumbs=array(
		'Projetos'=>array('/projeto/'),
		$projeto->nome => array('/projeto/view', 'p'=>'financeiro', 'id'=>$projeto->cod_projeto),
		'Adicionar Verba',
);

?>
<div class="well well-small">
<h5>Não há orçamentos vinculado para este projeto</h5>
Antes de adicionar algum recebimento ao projeto você deve especificar um orçamento para cada rubrica que será usada no projeto.
Estes orçamentos podem ser especificados pelo link <?php echo CHtml::link('Orçamentos', array('/projeto/update/', 'id'=>$projeto->cod_projeto, '#'=>'orcamento'))?>.
</div>