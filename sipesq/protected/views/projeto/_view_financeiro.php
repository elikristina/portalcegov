<?php 
			Yii::app()->clientScript->registerScript('pagamentos', "
						
		$('.detalhe_pagamento_btn').toggle(
			function(){
				a = $(this).parent();
				$(this).text('Ocultar Detalhes');
				b = a.children('div');
				b.show('fast');
				return false;
			},
			function(){
				a = $(this).parent();
				$(this).text('Detalhes');
				b = a.children('div');
				b.hide('fast');
				return false;
			}
		);
		
		$('#all_pagamento_fechado_btn').toggle(
			function(){
				$(this).text('Ocultar Pagamentos Fechados');
				$('.detalhe_pagamento').hide();
				$('.verde').show('fast');
				$('.detalhe_pagamento_btn').toggle();
				return false;
			},
			
			function(){
				$(this).text('Pagamentos Fechados');
				$('.verde').hide('fast');
				$('.detalhe_pagamento_btn').toggle('slow');
				return false;
			}
		
		);
		
		$('#all_pagamento_aberto_btn').toggle(
			function(){
				$(this).text('Ocultar Pagamentos Abertos');
				$('.detalhe_pagamento').hide();
				pagamentos = 
				$('.amarelo').show('fast');
				$('.detalhe_pagamento_btn').toggle();
				return false;
			},
			
			function(){
				$(this).text('Pagamentos Abertos');
				$('.amarelo').hide('fast');
				$('.detalhe_pagamento_btn').toggle('slow');
				return false;
			}
		
		);
		
		$('#all_detalhe_pagamento_btn').toggle(
			function(){
				$(this).text('Ocultar Pagamentos');
				$('.detalhe_pagamento').show('fast');
				$('.detalhe_pagamento_btn').toggle();
				return false;
			},
			
			function(){
				$(this).text('Mostrar Pagamentos');
				$('.detalhe_pagamento').hide('fast');
				$('.detalhe_pagamento_btn').toggle('slow');
				return false;
			}
		
		);
		
		");
?>

<?php Yii::app()->clientScript->registerScript('table_financeiro',"

$('.tbl-line-financeiro').hover(
 function(){
 $(this).addClass('table-line-over');
 }, 
 
 function(){
 	$(this).removeClass('table-line-over');
 }
);

")?>

<?php $valor_total_bolsistas = 0;?>
<h4>Informações Financeiras</h4>

	<div class="view">
	<div id="chart_financeiro"></div>
	<div id="dataview"></div>			
		<?php if($model->ultima_modificacao != null):?>
			<p>Última Modificação: <?php echo date("Y-m-d", strtotime($model->ultima_modificacao))?></p>
		<?php endif;?>
		<hr>
		
	 		<?php echo CHtml::submitButton('Criar Despesa / Verba', array('class'=>'btn btn-small btn-info', 'submit'=>array('projetoFinanceiro/create','id'=>$model->cod_projeto))); ?>
	 		<?php echo CHtml::submitButton('Gerenciar Despesas / Verbas', array('class'=>'btn btn-small btn-info', 'submit'=>array('projetoFinanceiro/admin','id'=>$model->cod_projeto))); ?>
		</div> <!-- Fim div table financeiro e gráficos -->
	
		<?php if(count($model->patrimonio_termos) > 0):?>
			<div class="view">
			<h4>Termos de Patrimônios</h4>
			<ul>
			<?php foreach($model->patrimonio_termos as $termo):?>
				 <li><b><?php echo CHtml::link(CHtml::encode('Termo ' .$termo->nro_termo_responsabilidade .' ( ' .$termo->responsavel .' )'), array('patrimonioTermo/view', 'id'=>$termo->cod_termo)); ?></b></li>
			<?php endforeach;?>
			</ul>
			<br><label>Total gasto em patrimônios:</label>
			R$<?php echo CHtml::encode(number_format($model->gasto_patrimonios,2,',','.'));?><br><br>
			</div>
		<?php endif;?>
		<?php if(count($model->livros) > 0):?>
		<div class="view">
			<h4>Livros</h4>
			<ul>
			<?php foreach($model->livros as $livro):?>
				 <li><b><?php echo CHtml::link(CHtml::encode($livro->titulo), array('livro/view', 'id'=>$livro->cod_livro)); ?></b></li>
			<?php endforeach;?>
			</ul>
			<br><label>Total gasto com livros:</label>
			R$<?php echo CHtml::encode(number_format($model->gasto_livros,2,',','.'));?>
			</div>
		<?php endif;?>
		<div class="view">
		<h4>Pagamentos</h4>
		
		<?php if(!Yii::app()->user->isGuest):?>	
		<b><?php echo CHtml::link('Mostrar Pagamentos','#',array('id'=>'all_detalhe_pagamento_btn')); ?> ::</b>
		<b><?php echo CHtml::link('Mostrar Pagamentos Abertos','#',array('id'=>'all_pagamento_aberto_btn')); ?> ::</b> 
		<b><?php echo CHtml::link('Mostrar Pagamentos Fechados','#',array('id'=>'all_pagamento_fechado_btn')); ?></b> <hr>
		<?php endif;?> 
		
		<ul>
		<?php foreach($model->pessoas_recebimento as $bolsista):?>
				<?php 
					$pessoa_bolsista = Pessoa::model()->findByPk($bolsista->cod_pessoa);
					$categoria = $bolsista->categoria;
					$valor_total_bolsistas += $bolsista->valor_total; 
				
				?>
					<li>
						 <b><?php echo CHtml::link(CHtml::encode($categoria . ' - ' .$pessoa_bolsista->nome), array('pessoaFinanceiro/view', 'id'=>$bolsista->cod_financeiro)); ?></b>
						 
						 
							<?php $this->renderPartial('_detalhe_pagamento',array(
								'pagamento'=>$bolsista,
							)); ?>
				
							<?php if(!Yii::app()->user->isGuest):?>
								<br><?php echo CHtml::link('Detalhes','#',array('class'=>'detalhe_pagamento_btn')); ?>
							<?php endif;?> 
					</li>
		<?php endforeach;?>
		</ul>
				
	</div><!-- Fim Info Financeiro -->
<script type="text/javascript">

      google.load("visualization", "1", {packages:["corechart", "table"]});

      google.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = new google.visualization.DataTable();

        data.addColumn('string', 'Origem');

        data.addColumn('number', 'Orçamentado');

        data.addColumn('number', 'Recebido');

        data.addColumn('number', 'Gasto');

        data.addColumn('number', 'Saldo');

        data.addRows(4);



        data.setValue(0, 0, 'Bolsas');

        data.setValue(0, 1, <?php echo $model->verba_bolsa;?>);

        data.setValue(0, 2, <?php echo $model->recebido_bolsa;?>);

        data.setValue(0, 3, <?php echo $model->gasto_bolsa;?>);

        data.setValue(0, 4, <?php echo ($model->recebido_bolsa - $model->gasto_bolsa);?>);

        



		data.setValue(1, 0, 'Custeio');

        data.setValue(1, 1, <?php echo $model->verba_custeio;?>);
        
        data.setValue(1, 2, <?php echo $model->recebido_custeio;?>);

        data.setValue(1, 3, <?php echo $model->gasto_custeio;?>);

        data.setValue(1, 4, <?php echo ($model->recebido_custeio - $model->gasto_custeio);?>);

        

	

		data.setValue(2, 0, 'Capital');

        data.setValue(2, 1,<?php echo $model->verba_capital;?>);

        data.setValue(2, 2,<?php echo $model->recebido_capital;?>);

        data.setValue(2, 3,<?php echo $model->gasto_capital;?>);

        data.setValue(2, 4,<?php echo ($model->recebido_capital - $model->gasto_capital);?>);

        

        data.setValue(3, 0, 'Outros');

        data.setValue(3, 1,<?php echo $model->verba_outros; ?>);

        data.setValue(3, 2,<?php echo $model->verba_outros; ?>);

        data.setValue(3, 3,<?php echo $model->gasto_outros; ?>);

        data.setValue(3, 4,<?php echo ($model->verba_outros - $model->gasto_outros); ?>);

        
        var formatter = new google.visualization.NumberFormat(
        	      { prefix: 'R$ ', negativeColor: 'red', negativeParens: false});
        		formatter.format(data, 0); 
  	  			formatter.format(data, 1); 
        	  	formatter.format(data, 2); 
        	  	formatter.format(data, 3);
        	  	formatter.format(data, 4); 


        	  	var chart = new google.visualization.ColumnChart(document.getElementById('chart_financeiro'));

		
		var chartOptions = {width: 650, height: 380, title: 'Projeto <?php echo $model->nome?>',
				colors: ['blue','green' ,'red', 'black'],
                hAxis: {title: 'Origem da verba', titleTextStyle: {color: 'red'}},
                vAxis: {title: 'Gastos em R$', titleTextStyle: {color: 'red'}},
                legend: 'right'
                
               };

		//Desenha o chart.
        chart.draw(data, chartOptions);

		$.getJSON('/sipesq/index.php/projeto/jsonFinanceiro/<?php echo $model->cod_projeto?>', function(json){
			

			 	jsonObj = eval(json);
			 	
			 var tblFinanceiro = new google.visualization.DataTable(jsonObj);
			 
			 var formatter = new google.visualization.NumberFormat(
	        	      { prefix: 'R$ ', negativeColor: 'red', negativeParens: false});
	        		formatter.format(tblFinanceiro, 0); 
	  	  			formatter.format(tblFinanceiro, 1); 
	        	  	formatter.format(tblFinanceiro, 2); 
	        	  	formatter.format(tblFinanceiro, 3);
	        	  	formatter.format(tblFinanceiro, 4); 
	        	  	
			
	        var view = new google.visualization.DataView(tblFinanceiro);
	        
	        var table = new google.visualization.Table(document.getElementById('dataview'));
	        
	        table.draw(view, {allowHtml: true});
		});
        


      }
 </script>