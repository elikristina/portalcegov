<?php
$this->breadcrumbs=array(
	Yii::t('default', 'gts'),
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-pencil"></i> Editar Introdução', 'url'=>array('updateIntro')),
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

<div class="row-fluid">
	<div class="span12">
		<?php echo $intro_content?>
	</div>
</div>

<br />

<?php $gts = GrupoTrabalho::model()->findAll(array('order'=>'nome', 'condition'=>'visible=true'));?>
					<?php foreach($gts as $key=>$gt):?>
					<?php echo $key%3==0 ? "<div class=\"row-fluid gt-index\">" : "" ;?>
						<div class="span4" >
							<h5><?php echo CHtml::link($gt->t('nome'), array('/gt/view', 'id'=>$gt->cod_gt));?></h5>
						</div>
					<?php echo $key==2 || $key==5 || $key==8 ? "</div>" : "" ;?>
					<?php endforeach;?>
				</div>
					

<br />



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