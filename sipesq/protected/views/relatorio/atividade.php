<?php
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi");
?>
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

		var categoria = $('#dropDownCategoria').val();
    	if(categoria){
        	url += '&categoria=' + categoria;
    	}

    	var finalizado = document.getElementById('checkBoxFinalizado').checked;
    	if(finalizado)
    		url += '&finalizado=1';
    	else
    		url += '&finalizado=0';

    	location.href = url;
	}
</script>
<script type="text/javascript">
	
      google.load("visualization", "1", {packages:["corechart"]});

     google.setOnLoadCallback(drawChart);

      function drawChart() {
    	 	 tAtividades = $('.atividade').size();
    		 
    		 pAndamento = $('.amarelo').length * 100 / tAtividades;
    		 pAtrasadas = $('.vermelho').length * 100 / tAtividades;
    		 pConcluidas = $('.verde').length * 100 / tAtividades;
    			
        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Atividades');

        data.addColumn('number', 'Concluídas');

        data.addColumn('number', 'Em Andamento');

        data.addColumn('number', 'Atrasadas');

        data.addRows(1);


        //data.setValue(0, 0, '');

        data.setValue(0, 1, pConcluidas);

        data.setValue(0, 2, pAndamento);

        data.setValue(0, 3, pAtrasadas);

        
        var formatter = new google.visualization.NumberFormat(
        	      {suffix: '%', negativeColor: 'red', negativeParens: true});
  	  			formatter.format(data, 1); 
        	  	formatter.format(data, 2); 
        	  	formatter.format(data, 3); 


        var chart = new google.visualization.ColumnChart(document.getElementById('chart_atividades'));

		
		var chartOptions = {width: 500, height: 250, title: 'Atividades',
				colors: ['green', 'yellow', 'red'],
              //  hAxis: {title: 'Atividades', titleTextStyle: {color: 'blue'}},
                vAxis: {title: 'Total Concluído', titleTextStyle: {color: 'red'}},
                legend: 'top'
                
               };

		//Desenha o chart.
        chart.draw(data, chartOptions);

      }
 </script>
<?php
$this->breadcrumbs=array(
	'Relatório de Atividades',
);

$this->menu=array(
	array('label'=>'Relatório de Atividades', 'url'=>array('atividade')),
	array('label'=>'Relatório de Projetos', 'url'=>array('projeto')),
);
?>

<h1>Relatório de Atividades</h1>

<div class="row-fluid">
    <div class="span12">
    <div class="input">
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
    </div>
    <br>
    <div class="input">
    <?php echo CHtml::dropDownList('dropDownCategoria',$categoria, CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')), 'cod_categoria', 'nome'), array('prompt'=>'Escolha uma Categoria',)); ?>
    </div>
    <br>

    <div class="input">
    <?php echo CHtml::dropDownList('dropDownProjeto',$projeto,CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome'), array('prompt'=>"Escolha um Projeto",));?>
    </div>

    <div class="input">
    <?php echo CHtml::checkBox('checkBoxFinalizado',$finalizado);?><b> Mostrar Somente Atividades Finalizadas</b>
    </div>
    <br>
    		
    <?php echo CHtml::submitButton('Limpar', array('id'=>'btnLimpar', 'submit'=>'atividade'));?>
    <?php echo CHtml::submitButton('Enviar', array('id'=>'btnEnviar', 'onclick'=>'filtraAtividade();'));?>
    </div>
</div>

<br>

<div class="row-fluid">
    <div class="span12">
        <div class="view" id="chart_atividades"></div>

        <?php $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$dataProvider,
        	'itemView'=>'_atividade',
        	'sortableAttributes'=>array(
             'data_inicio', 'data_fim', 'estagio',),
        )); ?>
    </div>
</div>


