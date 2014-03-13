<?php
$this->breadcrumbs=array(
	'Grupos de Trabalho',
);

$this->menu=array(
	array('label'=>'<i class="icon-plus"></i> Adicionar Grupo', 'url'=>array('create')),
	array('label'=>'<i class="icon-list"></i> Ordenar Grupos', 'url'=>array('sort')),
	array('label'=>'<i class="icon-tasks"></i> Gerenciar Grupos', 'url'=>array('admin')),
);


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
$url = $this->createUrl('/gt/sort');
Yii::app()->clientScript->registerScript('accordion',"
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

<h1>Grupos de Trabalho</h1>
<div id="msg-container"></div>
<p>
Arraste os GTs conforme queira ordená-los.
</p>

<ul id="sortable">
<?php foreach($grupos as $gt):?>
	<?php $this->renderPartial("_sort", $gt); ?>
<?php endforeach;?>
</ul>
<br>
<?php echo CHtml::link("Salvar", 
	'#',
	array(
		'id'=>'saveOrder',
		'class'=>"ui-button ui-button-text-only ui-widget ui-state-default ui-corner-all",
		'style'=>'padding: 4px;'
		)
	);?>