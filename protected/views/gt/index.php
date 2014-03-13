<?php
$this->breadcrumbs=array(
	Yii::t('default', 'gts'),
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-plus"></i> Adicionar Grupo', 'url'=>array('create')),
		array('label'=>'<i class="icon-list"></i> Ordenar Grupos', 'url'=>array('sort')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Grupos', 'url'=>array('admin')),
	);
}


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
Yii::app()->clientScript->registerScript('accordion',"
	$(document).ready(function(){
		$('#grupos').accordion({ header: 'h4', active: false,  collapsible: true, autoHeight: false });
	});
");
?>

<?php echo $intro_content?>

<?php if(Yii::app()->user->name == 'admin'): //Link para edição da introdução?>
<div >
<?php echo CHtml::link("Editar", 
	array("/gt/updateIntro"),
	array(
		'class'=>"btn btn-primary btn-small",
		)
	);?>
</div>
<?php endif;?>


<div id="grupos">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
</div>


<?php if((!Yii::app()->user->isGuest) && (GrupoTrabalho::model()->count('visible = false') > 0)): //Mostra para o usuários os GTs inativos?>
<br><br><hr>
<h2>Grupos Inativos</h2>
<?php
	//Busca os GTs inativos
	 $gtsInativos = GrupoTrabalho::model()->findAll(array('condition'=>'visible=false'));
	 //Renderiza todos os GTs inativos
	 foreach($gtsInativos as $gt){
	 	$this->renderPartial('_inativo', array('data'=>$gt));
	 }
?>
<br><br>
<?php endif;?>