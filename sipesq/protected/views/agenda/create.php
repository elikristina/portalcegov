<?php
$this->breadcrumbs=array(
	'Agenda'=>array('index'),
	'Adicionar',
);

?>

<h1><i>Sistema de Apoio ao Pesquisador - Agenda</i></h1>
<hr>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

<br>

<div class="view-esquerda">
<p><b>Pessoas em Férias</b><br>
<?php if(!Yii::app()->user->isGuest):?>
	<?php echo CHtml::link('Cadastrar Férias', array('agenda/createferias'))?><br>
<?php endif;?>
</p>

<?php $pessoas_ferias = Ferias::findAllInVacation();?>
<?php foreach($pessoas_ferias as $p):?>
	<?php echo $p->pessoa->nome_curto;?> - <i><?php echo date('M, d',strtotime($p->data_inicio))?> a <?php echo date('M, d',strtotime($p->data_fim))?></i>
	<?php if(!Yii::app()->user->isGuest):?> 
		- <?php echo CHtml::link('Editar', array('agenda/updateferias', 'id'=>$p->cod_pessoa, 'data_inicio'=>$p->data_inicio, 'data_fim'=>$p->data_fim))?>
	<?php endif;?>
	 <br>
	
<?php endforeach;?>
</div>

<div class="view-direita">
<p><b>Próximas Férias</b><br>
</p>

<?php $proximas_ferias = Ferias::findNextVacations();?>
<?php foreach($proximas_ferias as $p):?>
	<?php echo $p->pessoa->nome_curto;?> - <i><?php echo date('M, d',strtotime($p->data_inicio))?> a <?php echo date('M, d',strtotime($p->data_fim))?></i>
	<?php if(!Yii::app()->user->isGuest):?> 
	- <?php echo CHtml::link('Editar', array('agenda/updateferias', 'id'=>$p->cod_pessoa, 'data_inicio'=>$p->data_inicio, 'data_fim'=>$p->data_fim))?>
	<?php endif;?>
	 <br>
	
<?php endforeach;?>
</div>