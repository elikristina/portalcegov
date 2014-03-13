<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
Yii::app()->clientScript->registerScript('accordion',"
	$(document).ready(function(){
		$('#categoria').accordion({ header: 'h4', active: false,  collapsible: true, autoHeight: false });
	});
");

Yii::app()->clientScript->registerScript('accordion-sub',"
	$(document).ready(function(){
		$('.sub-categoria').accordion({ header: 'h5', active: false,  collapsible: true, autoHeight: false });
	});
");
$url = $this->createUrl('/pessoa/view');
Yii::app()->clientScript->registerScript('view-pessoa',"
	$('.view-pessoa').click(function(){
		location.href = '{$url}' + '/' + $(this).attr('id');
	});
");

$this->breadcrumbs=array(
	Yii::t('default','equipe'),
);

if (Yii::app()->user->name =='admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Pessoas', 'url'=>array('admin')),
		array('label'=>'<i class="icon-plus"></i> Adicionar Categoria', 'url'=>array('categoria/create')),
		array('label'=>'<i class="icon-list"></i> Ordenar Categorias', 'url'=>array('categoria/index')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Categorias', 'url'=>array('categoria/admin')),
	);
}

?>
<div class="row-fluid">
	<div class="span12">
		<?php echo $intro_content?>
		
		<?php if(Yii::app()->user->name == 'admin'): //Link para edição da introdução?>
		<?php echo CHtml::link("Editar", 
			array("/pessoa/updateIntro"),
			array(
				'class'=>"btn btn-primary btn-small",
				)
			);?>
		<br><br>
		<?php endif;?>
	</div><!-- span -->
</div> <!-- row -->

<div class="row-fluid">
<div id="categoria" class="span12">
<?php foreach($data as $categoria):?>
	<?php  if(count($categoria->pessoas) > 0 || count($categoria->secundarias) > 0):?>
		<div>
			<h4><a href="#"><?php echo CHtml::encode($categoria->t('nome'));?></a></h4>
			<div> <!-- CONTEUDO ACCORD PAI -->
					<?php if(count($categoria->secundarias) > 0):?>
						<?php foreach($categoria->secundarias as $sec):?>
							<?php foreach($sec->pessoas as $p):?>
								<?php $this->renderPartial('_pessoa', array('data'=>$p, 'categoria'=>$sec->t('nome'))); ?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php else:?>
						<?php foreach($categoria->pessoas as $p):?>
							<?php  $this->renderPartial('_pessoa', array('data'=>$p));?>
						<?php endforeach;?>
					<?php endif;?>
			</div> <!-- FIM CONTEUDO ACCORD PAI -->
		</div> <!-- FIM ACCORD PAI -->
	<?php endif;?>
<?php endforeach;?>
	</div><!-- span -->
</div> <!-- row -->
