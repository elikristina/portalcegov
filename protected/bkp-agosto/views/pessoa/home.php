<script>

</script>


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

Yii::app()->clientScript->registerScript('view-pessoa',"
	$('.view-pessoa').click(function(){
		location.href = $(this).attr('id');
	});
");

$this->breadcrumbs=array(
	'Equipe',
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'Ordenar Categorias', 'url'=>array('categoria/index')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('categoria/admin')),
);
?>


<?php echo $intro_content?>

<?php if(!Yii::app()->user->isGuest): //Link para edição da introdução?>
<div class="row">
<?php echo CHtml::link("Editar", 
	array("/pessoa/updateIntro"),
	array(
		'class'=>"button",
		)
	);?>
</div>
<br><br>
<?php endif;?>

<div id="categoria">
<?php foreach($data as $categoria):?>
	<?php  if(count($categoria->pessoas) > 0 || count($categoria->secundarias) > 0):?>
		<div>
			<h4><a href="#"><?php echo CHtml::encode($categoria->nome);?></a></h4>
			<div> <!-- CONTEUDO ACCORD PAI -->
					<?php if(count($categoria->secundarias) > 0):?>
						<?php foreach($categoria->secundarias as $sec):?>
							<?php foreach($sec->pessoas as $p):?>
								<?php $this->renderPartial('_pessoa', array('data'=>$p, 'categoria'=>$sec->nome));?>
							<?php endforeach;?>
						<?php endforeach;?>
					<?php else:?>
						<?php foreach($categoria->pessoas as $p):?>
							<?php $this->renderPartial('_pessoa', array('data'=>$p));?>
						<?php endforeach;?>
					<?php endif;?>
			</div> <!-- FIM CONTEUDO ACCORD PAI -->
		</div> <!-- FIM ACCORD PAI -->
	<?php endif;?>
<?php endforeach;?>
</div>

