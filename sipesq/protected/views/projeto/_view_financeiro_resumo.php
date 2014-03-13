<?php 
/* @var $this ProjetoController */
/* @var $model Projeto */
$url = $this->createUrl('/projeto/morrisData', array('id'=>$model->cod_projeto));
$baseUrl = Yii::app()->baseUrl;// .'/js/morris/';
Yii::app()->clientScript->registerScriptFile("{$baseUrl}/js/morris/raphael-min.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerScriptFile("{$baseUrl}/js/morris/morris-0.4.3.min.js", CClientScript::POS_HEAD);
Yii::app()->clientScript->registerCssFile("{$baseUrl}/js/morris/morris-0.4.3.min.css");


Yii::app()->clientScript->registerScript('morris',"

	$.getJSON('{$url}', function(data){

		console.log(data);
	Morris.Line({
	  element: 'morris',
	  data: data,
	  xkey: 'y',
	  ykeys: ['receitas', 'despesas'],
	  labels: ['Receitas', 'Despesas'],
	  xLabels: ['year'],
	  lineColors: ['#0480be', '#dd514c'],
	  parseTime: false,	  
	  yLabelFormat: function (y) { 
		  	y += '';
			x = y.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? ',' + x[1] : ',00';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
			}
			return 'R$ ' + x1 + x2;
	  }
	  
	});



	});

Morris.Bar({
  element: 'morris2',
  data: [
    { y: 'Orçamentado', a: 89},    
    { y: 'Recebido', a: 33},  
    { y: 'Gasto Corrente', a: 24},    
    { y: 'Gasto Comprometido', a: 19},
    { y: 'Saldo', a: 10},    
    { y: 'Saldo Corrente', a: 30}    

  ],
  xkey: 'y',
  ykeys: ['a'],
  labels: ['Valor'],
  xLabelAngle: 0,
  hideHover: true,
  barColors: function (row, series, type) {  	
  	var colors = ['#25BA37', '#40C950', '#CC4523', '#E37768','#3E60CF','#5F7DDE'];
    return colors[row.x];
   }
});
	

");
?>

<div class="row-fluid">
	<div class="span12">
		<b>Orçamentado:</b> R$ <?php echo number_format($model->verba_orcamentada, 2, ',','.')?><br>
		<b>Recebido:</b> R$ <?php echo number_format($model->verba_recebida, 2, ',','.')?><br>
		<b>Gastos Comprometidos:</b> R$ <?php echo number_format($model->gasto_comprometido, 2, ',','.')?><br>
		<b>Saldo Disponível:</b> R$ <?php echo number_format($model->saldo_disponivel, 2, ',','.')?><br>
		<div class="progress">
			<?php if ($model->verba_recebida == 0)  $model->verba_recebida = -1; ?>
			<div class="bar bar-danger" style="width: <?php echo ($model->gasto_comprometido / $model->verba_recebida)*100?>%;"></div>
			<div class="bar" style="width: <?php echo ($model->saldo_disponivel / $model->verba_recebida)*100?>%;"></div>
		</div>
	</div>

	
 </div>
<div class="row-fluid">
 <div class="span12">
		<div id="morris" style="max-width: 90%;"></div>
		<div id="morris2"></div>
</div>
</div>	