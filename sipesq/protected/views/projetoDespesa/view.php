<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */

Yii::app()->clientScript->registerScript("print", "
$('.tip').tooltip();
");

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$model->projeto->nome=>array('/projeto/view', 'id'=>$model->projeto->cod_projeto),
	'Receita #'.$model->cod_verba => array('/projetoVerba/view', 'id'=>$model->cod_verba),	
	$model->nome,
);

$this->menu=array(
	array('label'=>'<i class="icon icon-arrow-left"></i> Voltar ao Projeto', 'url'=>array('/projeto/view', 'id'=>$model->projeto->cod_projeto)),
	array('label'=>'<i class="icon icon-plus"></i> Adicionar Despesa', 'url'=>array('create')),
	array('label'=>'<i class="icon icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$model->cod_despesa)),
	array('label'=>'<i class="icon icon-trash"></i> Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_despesa),'confirm'=>'Tem certeza que deseja deletar esta despesa?')),
);
?>



<h2><?php echo $model->nome; ?></h2>



<div class="view">

	<b><?php echo CHtml::encode($model->getAttributeLabel('nome')); ?>:</b>
	<?php echo CHtml::encode($model->nome); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('comprador')); ?>:</b>
	<?php echo CHtml::encode($model->comprador); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('cod_rubrica')); ?>:</b>
	<?php echo CHtml::encode($model->rubrica->nome); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('cod_projeto')); ?>:</b>
	<?php echo CHtml::encode($model->projeto->nome); ?>
	<br /> 
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('quantidade')); ?>:</b>
	<?php echo CHtml::encode($model->quantidade); ?> <?php echo ($model->quantidade > 1) ? 'meses' : 'mês'?>
	<br />
	

	<b><?php echo CHtml::encode($model->getAttributeLabel('valor')); ?>:</b>
	R$ <?php echo CHtml::encode(number_format($model->valor,2,',','.')); ?>
	<br />
	
	<b>Valor Total:</b>
	R$ <?php echo CHtml::encode(number_format($model->valor * $model->quantidade,2,',','.')); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('descricao')); ?>:</b>
	<?php echo $model->descricao; ?>
	<br />

	
	<b><?php echo CHtml::encode($model->getAttributeLabel('data_compra')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_compra)); ?>
	<br />
	
	<?php if($model->documento != null && $model->documento != ''):?>
		<b><?php echo CHtml::encode($model->getAttributeLabel('documento')); ?>:</b>
		<?php echo CHtml::link(substr($model->documento, stripos($model->documento, '_') + 1) .' <i class="icon icon-download"></i>', array('downloadFile', 'file'=>$model->documento), array('class'=>'tip', 'title'=>"Baixar Arquivo")); ?>
		<br />
	<?php endif;?>
</div>

<?php if(count($model->infos)):?>
<div class="view">
	<?php foreach($model->infos as $key=>$info):?>
	<div class="row">
		<?php $this->renderPartial('_info', array('model'=>$info, 'key'=>$key))?>
	</div>
	<?php endforeach;?>
</div>
<?php endif;?>
	
	<div class="view info-adicional">
		<b>Cadastrado por:</b>
		<?php echo CHtml::encode($model->criador->nome); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('data_inclusao')); ?>:</b>
		<?php echo CHtml::encode(Sipesq::date($model->data_inclusao)); ?>
		<br />
		
		<b><?php echo CHtml::encode($model->getAttributeLabel('data_edicao')); ?>:</b>
		<?php echo CHtml::encode(Sipesq::date($model->data_edicao)); ?>
		<br />
		<br />
		
		<?php echo CHtml::link('Relatório FAURGS <i class="icon icon-download"></i>', array('geraXml', 'id'=>$model->cod_despesa), array('class'=>'btn btn-small tip link', 'title'=>"Baixar Arquivo"))?>
		<br/>
	</div>
<hr>
<h2>Patrimônios</h2>
<?php
 $criteria = new CDbCriteria();
 $criteria->compare('cod_projeto_despesa', $model->cod_despesa);
 $dataProvider=new CActiveDataProvider('Patrimonio', array('criteria'=>$criteria));
 ?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/patrimonio/_view',
)); ?>
