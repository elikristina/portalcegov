<?php
/**
 * @var $this ProjetoController
 * @var $model Projeto
 */

$bottom = date('Y', strtotime($model->atividades[0]->data_inicio));
$monthBottom = date('m', strtotime($model->atividades[0]->data_inicio));
$top = date('Y', strtotime($model->atividades[count($model->atividades) -1]->data_fim));
$gap = $top - $bottom + 1;
?>
<?php Yii::app()->clientScript->registerLinkTag('stylesheet/less','text/css',Yii::app()->request->baseUrl ."/css/grantt.less");?>
<h1><?php echo $model->nome?></h1>
<div class="grantt">
<table class="grantt">
<thead>
<tr>
	<th>Atividade/Mes</th>
	<?php $times = array();?>
	<?php for($i=$monthBottom; $i<12*$gap; $i++): ?>
		<th><?php  echo date('m/y', mktime(0,0,0,$i+2,0,$bottom)) ?></th>
		<?php  $times[count($times)] =  mktime(0,0,0,$i+2,0,$bottom); ?>
	<?php endfor; ?>
</tr>
</thead>
<tbody class="grantt-body">

<?php foreach($model->atividades as $key=>$atividade): ?>
<tr >
	<td class="fixed" style="border-bottom: solid 1px; border-right: solid 1px;"><?php echo $atividade->nome_atividade?> </td>
	<?php $dia = date('d', strtotime($atividade->data_inicio))?>
	<?php for($j=0, $k=$monthBottom; $j< ( 12*$gap - $monthBottom) ; $j++, $k++): ?>
	<?php  $time =  mktime(0,0,0,$k+2,$dia,$bottom); ?>
		<?php  if($time >=  strtotime($atividade->data_inicio) AND $time <= strtotime($atividade->data_fim)):?>
		<td style="background-color: #ccf; border-bottom: solid 1px; border-right: solid 1px;">
		</td>
		<?php else:?>
		<td style="border-bottom: solid 1px; border-right: solid 1px;">
		</td>
		<?php  endif;?>
	<?php endfor; ?>
</tr>
<?php endforeach;; ?>
</tbody>
</table>
</div>