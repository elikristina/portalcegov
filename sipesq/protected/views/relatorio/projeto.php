<script>
function filtraAtividade (){
    	var url = '?';

		var inicio = encodeURIComponent($('#inicio').val());
		if(inicio)
    		url += '&inicio=' + inicio;
		
    	var termino = encodeURIComponent($('#termino').val());
    	if(termino)
    		url += '&termino=' + termino;
    	

    	var projeto = $('#dropDownProjeto').val();
		if(projeto){
    	 url += '&projeto=' + projeto; 
    	}

    	location.href = url;
	}
function filtraStatus(){

    location.href = '?stat=' + $('#dropProjeto').val();
}
</script>


<?php
$this->breadcrumbs=array(
	'Relatório de Projetos',
);

$this->menu=array(
	array('label'=>'Relatório de Atividades', 'url'=>array('atividade')),
	array('label'=>'Relatório de Projetos', 'url'=>array('projeto')),
);
?>


<h1>Relatório de Projetos</h1>
<!--
<div class="row-fluid">
<label><b>Ínicio</b></label>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'inicio',
				'value'=>isset($inicio) ? $inicio : null,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop',),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
 -
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'termino',
				'value'=>isset($termino) ? $termino : null,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop',),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
<label><b>Término</b></label>
</div> -->
<br>

<div class="row-fluid">
    <?php echo CHtml::dropDownList('dropProjeto'
        , $stat
        , Projeto::$momentos
        , array('class'=>'input-xxlarge'
            , 'prompt'=>'Selecionar Estado'
            , 'id'=>'dropProjeto'
            , 'onchange'=>'filtraStatus();')); ?>
</div>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_projeto',
	'sortableAttributes'=>array(
     'data_inicio', 'data_fim',),
)); ?>



