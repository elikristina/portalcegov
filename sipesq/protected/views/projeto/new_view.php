
<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$model->nome,
);

$this->menu=$model->viewMenu();

Yii::app()->clientScript->registerScript("activeTabs", "
(function(){
	$('#{$activeTab}').addClass('active');
})();
");

?>

<h2><?php echo $model->nome; ?></h2>
<div class="tabbable tabs-left">
<ul class="nav nav-tabs" id="myTab">
  <li id="tab-info"><?php echo CHtml::link("Informações", array('/projeto/info', 'id'=>$model->cod_projeto))?></li>
  <?php if($model->isSupport() || Sipesq::getPermition('projeto.financeiro')):?>
    <li id="tab-financeiro"><?php echo CHtml::link("Financeiro", array('/projeto/financeiro', 'id'=>$model->cod_projeto))?></li>
  <?php endif;?>
  <li id="tab-atividades"><?php echo CHtml::link("Atividades", array('/projeto/atividades', 'id'=>$model->cod_projeto))?></li>
  <li id="tab-docs"><?php echo CHtml::link("Documentos", array('/projeto/docs', 'id'=>$model->cod_projeto))?></li>
  <?php if(Sipesq::getPermition('projeto.gerencial') > 0):?>
    <li id="tab-gerencial"><?php echo CHtml::link("Gerencial", array('/projeto/gerencial', 'id'=>$model->cod_projeto))?></li>
  <?php endif; ?>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="info">
  	<?php $this->renderPartial($partialView, array('model'=>$model)); ?>
  </div>
</div>

</div>