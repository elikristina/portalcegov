<?php
/* @var $this FerramentaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ferramentas',
);

$this->menu=array(
	array('label'=>'Create Ferramenta', 'url'=>array('create')),
	array('label'=>'Manage Ferramenta', 'url'=>array('admin')),
);
?>

<h2><?php echo Yii::t('default', 'ferramentas');?></h2>
<br />
<div class="">
		<?php $this->widget('zii.widgets.CListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			'summaryText'=>'',
		)); ?>
</div>


<?php  
/*

$rows = Yii::app()->db_sipesq->createCommand("SELECT nome FROM pessoa ORDER BY nome ASC")->queryAll(); 

foreach($rows as $r){
echo $r['nome'];
echo "<br>";
}
*/

?>