<?php
/* @var $this RubricaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Rubricas',
);

$this->menu=array(
	array('label'=>'<i class="icon-tasks"></i> Listar Rubricas', 'url'=>array('index')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Rubrica', 'url'=>array('create')),
);

function printChildren($father){

	 		if($father != null){
	 			echo '<li>';
	 			echo CHtml::link($father->nome . ' - ' .$father->numero
	 			, array('/rubrica/view', 'id'=>$father->cod_rubrica));
	 			echo '</li>'; 
	 			echo "<ul class=''>";
	 			foreach ($father->filhas as $filha){
	 				printChildren($filha);
	 			}
	 			echo "</ul>";
	 		}
	 		
	 		
}

Yii::app()->clientScript->registerScript('tips',"
		$('.tip').tooltip();
	");

?>

<h1>Rubricas</h1>



<div class="view">
<?php 
	$rubricas = Rubrica::model()->findAll(array('condition'=>'cod_rubrica_pai IS NULL'));
	echo "<ul>";
	foreach($rubricas as $r){
		echo "<li>";
		 printChildren($r);
		 echo '</li>';
	}
	echo '</ul>';

?>

<?php /*
	<table class="table table-bordered table-striped table-hover">

	<thead>
	<tr>
	<th>Nome da Rubrica</th>
	<th>Número</th>
	<th>Menu</th>
	</tr>
	</thead>
	<?php
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	));  ?>
	</table>
</div>

*/ ?>