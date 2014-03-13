<?php
/**
 * @var $this ProjetoController
 * @var $model Projeto
 */

Yii::app()->clientScript->registerLinkTag('stylesheet/less','text/css',Yii::app()->request->baseUrl ."/css/grantt.less");

$bottom = date('Y', strtotime($model->atividades[0]->data_inicio));
$monthBottom = date('m', strtotime($model->atividades[0]->data_inicio));
$top = date('Y', strtotime($model->atividades[count($model->atividades) -1]->data_fim));
$gap = $top - $bottom + 1;
?>
<h1><?php echo $model->nome?></h1>

<div class="grantt-head">
	<div class="span-4">
		Atividades/Mês
	</div>
	<div class="span-20 last">
		<?php $times = array();?>
		<ul class="grantt-header">
		<?php for($i=$monthBottom; $i<12*$gap; $i++): ?>
			<li class="grantt-cell"><?php  echo date('m/y', mktime(0,0,0,$i+2,0,$bottom)) ?></li>
			<?php  $times[count($times)] =  mktime(0,0,0,$i+2,0,$bottom); ?>
		<?php endfor; ?>
		</ul>
	</div>
</div>
<hr>
<div class="grantt-body">
<?php foreach($model->atividades as $key=>$atividade): ?>
	<div style="float: left; max-width: 100px;">
	<?php echo $atividade->nome_atividade?>
	 </div>
	<?php $dia = date('d', strtotime($atividade->data_inicio))?>
<!--	<div class="span-20 last grantt-list" >-->
		<div style="overflow: auto; max-width: 300px;">
<!--		<ul class="grantt-list">-->
		<?php for($j=0, $k=$monthBottom; $j< ( 12*$gap - $monthBottom) ; $j++, $k++): ?>
		<?php  $time =  mktime(0,0,0,$k+2,$dia,$bottom); ?>
			<?php  if($time >=  strtotime($atividade->data_inicio) AND $time <= strtotime($atividade->data_fim)):?>
			<div class="grantt-cell active">s</div>
			<?php else:?>
			<div class="grantt-cell"></div>
			<?php  endif;?>
		<?php endfor; ?>
<!--		</ul>-->
		</div>
<!--	</div>-->
	<hr>
<?php endforeach;; ?>
</div>
