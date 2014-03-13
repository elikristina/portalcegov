<?php
/* @var $this ProjetoVerbaController */
/* @var $model ProjetoVerba */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->projeto->nome=>array('/projeto/view', 'id'=>$model->projeto->cod_projeto),
	'Receitas'=>array('/projeto/view','p'=>'financeiro', 'id'=>$model->projeto->cod_projeto),
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar ao Projeto', 'url'=>array('/projeto/view', 'p'=>'financeiro', 'id'=>$model->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-plus"></i> Adicionar Receita', 'url'=>array('create', 'id'=>$model->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$model->cod_verba)),
	array('label'=>'<i class="icon icon-trash"></i> Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_verba),'confirm'=>'Tem certeza que deseja deletar esta receita?')),
);


Yii::app()->clientScript->registerScript('tips', "
	$('.tip').tooltip();	
");
?>



<h2> Receita #<?php echo $model->cod_verba;?></h2>
<h5><i><?php
				$rubricas = Array(); foreach($model->rubricas as $r){ $rubricas[] = $r->nome; } ;
				 echo CHtml::encode(implode(', ', $rubricas));
		 ?></i></h5>

<div class="view">
	<b>Total Orçamentado:</b> R$ <?php echo number_format($model->getOrcamentado(), 2,',','.');?><br>
	<b>Total Recebido:</b> R$ <?php echo number_format($model->recebido, 2,',','.');?><br>
	<b>Gasto Corrente:</b> R$ <?php echo number_format($model->gasto_corrente, 2,',','.');?><br>
	<b>Gasto Comprometido:</b> R$ <?php echo number_format($model->gasto_comprometido, 2,',','.');?><br>
	<b>Saldo Corrente:</b> R$ <?php echo number_format($model->saldo_corrente, 2,',','.');?><br>
	<b>Saldo Disponível:</b> R$ <?php echo number_format($model->saldo_comprometido, 2,',','.');?><br>
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('data_desembolso')); ?>:</b>
	<?php echo CHtml::encode(date('d/m/Y',strtotime($model->data_desembolso))); ?>
	
	<p>
		<b><?php echo CHtml::encode($model->getAttributeLabel('descricao')); ?>:</b><br>
		<?php echo $model->descricao?>
	</p>
	
	
	<ul class="nav nav-tabs">
		  <li class="active"><a href="#tab-desembolsos" data-toggle="tab">Desembolsos</a></li>
		  <li><a href="#tab-despesas" data-toggle="tab">Despesas</a></li>
		  <li><a href="#tab-patrimonios" data-toggle="tab">Patrimonios</a></li>
		</ul>
			
		<div class="tab-content">	
			<div class="tab-pane active" id="tab-desembolsos">
				<?php $this->renderPartial('financeiro/_desembolsos', array('verba'=>$model))?>
			</div>
				
			<div class="tab-pane" id="tab-despesas">
				<?php $this->renderPartial('financeiro/_despesas', array('verba'=>$model))?>
			</div>
			
			<div class="tab-pane" id="tab-patrimonios">
				<?php $this->renderPartial('financeiro/_patrimonios', array('verba'=>$model))?>
			</div>
			
		</div>
	
</div>