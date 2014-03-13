<?php
/* @var $this ProjetoVerbaController */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/'),
	$model->projeto->nome => array('/projeto/view', 'p'=>'financeiro', 'id'=>$model->projeto->cod_projeto),
	'Adicionar Receita',
);
?>

<h1><?php echo $model->projeto->nome?></h1>
<h3>Adicionar Receita</h3>

<?php if(count($rubricas) > 0):?>
	<?php echo $this->renderPartial('_form', array('model'=>$model, 'rubricas'=>$rubricas)); ?>
<?php else:?>
	<?php echo $this->renderPartial('_alert_rubricas', array('model'=>$model, 'rubricas'=>$rubricas)); ?>
<?php endif;?>