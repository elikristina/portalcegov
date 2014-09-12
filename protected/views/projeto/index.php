<?php
$this->breadcrumbs=array(Yii::t('default', 'projetos'));

$this->menu=array(
);
?>


<h2><?php echo Yii::t('default','projetos')?></h2>
<table class="table table-projetos table-striped">
<thead>
<tr>
	<th><?php echo Yii::t('default','projeto')?></th>
	<th><?php echo Yii::t('default','gt')?></th>
</tr>
</thead>
<tbody>
	
<?php  $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataGts,
	'itemView'=>'/projeto/_table_row',
)); ?>

</tbody>
</table>