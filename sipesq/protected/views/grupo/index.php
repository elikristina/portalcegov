<?php
/* @var $this GrupoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Grupos',
);

$this->menu=array(
	array('label'=>'Create Grupo', 'url'=>array('create')),
	array('label'=>'Manage Grupo', 'url'=>array('admin')),
);
?>

<h3>Grupos</h3>
<div class="view">
	<dl>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
	</dl>
</div>


<div id="modal_pessoas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modal_pessoasLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="modal_pessoasLabel">Pessoas do Grupo</h3>
  </div>
  <div class="modal-body" id="modal_pessoas_body">
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>

<script>

$('.modal-trigger').click(function(e){
 	e.preventDefault();
 	$("#modal_pessoas_body").load($(this).attr('href'));
 	$('#modal_pessoas').modal({
	  remote: $(this).attr('href')
	});
});
</script>


