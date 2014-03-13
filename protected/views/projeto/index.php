<?php
$this->breadcrumbs=array(Yii::t('default', 'projetos'));

$this->menu=array(
);
?>


<h3><?php echo Yii::t('default','projetos')?></h3>
<table class="table  table-condensed table-hover table-striped">
<thead>
<tr>
	<th><?php echo Yii::t('default','projeto')?></th>
	<th><?php echo Yii::t('default','gt')?></th>
</tr>
</thead>
<tbody>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/projeto/_table_row',
)); ?>
</tbody>
</table>

