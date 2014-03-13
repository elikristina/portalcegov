<?php
$this->breadcrumbs=array(
	'Categorias',
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
	array('label'=>'Adicionar Categoria', 'url'=>array('categoria/create')),
	array('label'=>'Ordenar Categorias', 'url'=>array('categoria/admin')),
	array('label'=>'Gerenciar Categorias', 'url'=>array('categoria/admin')),
);


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
$url = $this->createUrl('/categoria/sort');
Yii::app()->clientScript->registerScript('sort',"
	$(document).ready(function(){
		$('#sortable').sortable();
		$('#sortable').disableSelection();
		$('#saveOrder').click( 
		function(){
			var order = $('#sortable').sortable('toArray')
			
			var jqxhr = $.post(
				 	'{$url}',
				 	
				 	{ 'Sort[]': order }, 
				 	
					function(data) {
  					$('#msg-container').append(data);
	  					// Dialog
					$('#msg').dialog({
						autoOpen: false,
						width: 600,
						buttons: {
							'Ok': function() {
								$(this).dialog('close');
							}
						}
					});
					$('#msg').dialog('option', 'title', $('#msg-window').attr('title'));
					$('#msg').dialog('open');
  					
					})
					.error(function(){alert('Não foi possível salvar as alterações')});	
				
			
		});		
		
		
	});
");
?>

<h1>Categorias de Pessoas</h1>
<div id="msg-container"></div>
<p>
Arraste as categorias conforme queira ordená-las.
</p>

<ul id="sortable">
<?php foreach($categorias as $cat):?>
	<?php $this->renderPartial("_sort", $cat); ?>
<?php endforeach;?>
</ul>
<br>
<?php echo CHtml::link("Salvar Ordem", 
	'#',
	array(
		'id'=>'saveOrder',
		'class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all",
		'style'=>'padding: 4px;'
		)
	);?>