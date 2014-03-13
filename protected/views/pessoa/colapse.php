<?php
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");

$url = $this->createUrl('/pessoa/view');
Yii::app()->clientScript->registerScript('view-pessoa',"
	$('.view-pessoa').click(function(){
		location.href = '{$url}' + '/' + $(this).attr('id');
	});
");

$this->breadcrumbs=array(
	'Equipe',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'<i class="icon-plus"></i> Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'<i class="icon-list"></i> Ordenar Categorias', 'url'=>array('categoria/index')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Categorias', 'url'=>array('categoria/admin')),
);
?>

<div class="row-fluid">
	<div class="span12">
		<?php echo $intro_content?>
		
		<?php if(!Yii::app()->user->isGuest): //Link para edição da introdução?>
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
<div id="categoria" class="span10">


<div class="accordion" id="accordion">

<?php foreach($data as $categoria):?>
	<?php  if(count($categoria->pessoas) > 0 || count($categoria->secundarias) > 0):?>

  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $categoria->cod_categoria?>">
        <?php echo CHtml::encode($categoria->nome);?>
      </a>
    </div>
    <?php if(count($categoria->secundarias) > 0):?>
    <div id="collapse<?php echo $categoria->cod_categoria?>" class="accordion-body collapse">
		<?php foreach($categoria->secundarias as $sec):?>
			<?php foreach($sec->pessoas as $p):?>
			      <div class="accordion-inner">
			      	<?php $this->renderPartial('_pessoa', array('data'=>$p, 'categoria'=>$sec->nome));?>
			      </div>
			    
			<?php endforeach;?>
		<?php endforeach;?>
	</div>
	<?php else:?>
	<div id="collapse<?php echo $categoria->cod_categoria?>" class="accordion-body collapse">
	<?php foreach($categoria->pessoas as $p):?>
      		<div class="accordion-inner">
        		<?php $this->renderPartial('_pessoa', array('data'=>$p));?>
      		</div>
	<?php endforeach;?>
	</div>
	<?php endif;?>
	 </div><!-- Acoordion group -->
  	<?php endif;?>
<?php endforeach;?>

</div><!-- accordion -->

	</div><!-- span -->
</div> <!-- row -->