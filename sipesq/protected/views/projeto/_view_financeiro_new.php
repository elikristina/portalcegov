<?php 
/* @var $this ProjetoController */
/* @var $model Projeto */
$url_despesas = $this->createUrl('/projeto/ajaxDespesas', array('projeto'=>$model->cod_projeto));
Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl ."/js/charts.js", CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl .'/css/arvoredespesas.css');
Yii::app()->clientScript->registerScript('bars',"

$('.progress').hover(function(){
	$(this).addClass('active');
}, function(){
	$(this).removeClass('active');
});

$('.tip').tooltip();
		

$('#modal-info').on('hide', function(){
	$('.modal-body').html('<i class=\"icon icon-refresh\"></i> Carregando...');
});
		
$('#tipodespesa').change(function(){
	$('.desp-detail').hide();
	$('.desp-' + $(this).val()).show();
});

");





function imprimeLista($rubrica=null, $cod_projeto, $padding=0){
	if($rubrica != null){
	
		echo "<li class=\"rubrica\">";
		echo "<span class='rubrica-titulo'>";
		echo $rubrica->nome;
		echo "<span class='rubrica-valor'>";
		echo " R$ " .number_format($rubrica->calculaGastos($rubrica, $cod_projeto), 2, ',', '.');
		echo " / R$ " .number_format($rubrica->calculaReceitas($rubrica, $cod_projeto), 2, ',', '.');
		echo "</span>";
		echo "</span>";
		
		
		echo "<ul class='arvore'>";	
		foreach($rubrica->despesas as $desp){
			if($desp->cod_projeto == $cod_projeto){
				echo "<li>";
				echo CHtml::link(CHtml::encode($desp->nome), array('/projetoDespesa/view', 'id'=>$desp->cod_despesa));
				echo "</li>";				
			}
		}
		//echo "</ul>";
		
		
		foreach($rubrica->filhas as $filha){
			imprimeLista($filha, $cod_projeto, $padding+10);
		}
		
		echo "</ul></li>";
			
	}
	
}

$criteria = new CDbCriteria();
$criteria->with = 'receitas';
$criteria->compare('receitas.cod_projeto', $model->cod_projeto);
$criteria->together = true;

$rubricas = Rubrica::model()->findAll($criteria);
$receitas = $model->receitas;

$despesas = array();
foreach($model->receitas as $rec){
	foreach ($rec->despesas as $desp){
		$despesas[] = $desp;
	}
}
?>


<div class="tsabbable tabs-sleft">

<ul class="nav nav-tabs">
	  
      <li class="active"><a href="#view-table" data-toggle="tab">Tabela</a></li>
      <li><a href="#view-charts" data-toggle="tab">Gráficos</a></li>
      <li><a href="#view-resumo" data-toggle="tab">Resumo</a></li>
</ul>


<div class="tab-content">
	
	<div class="tab-pane active" id="view-table">
		<div id="tabela-financeiro">
			<div  class="tabela_detalhes " >
			
				<ul class="nav nav-pills">
				  <li><a href="#info-orcamento" data-toggle="tab">Orçamentos</a></li>
				  <li><a href="#info-recebimentos" data-toggle="tab">Recebimentos</a></li>
				  <li class="active"><a href="#info-despesas" data-toggle="tab">Despesas</a></li>
				  <li><a href="#info-patrimonios" data-toggle="tab">Patrimônios</a></li>
				</ul>
					
				<div class="tab-content">	
					<div class="tab-pane" id="info-orcamento">
						<?php $this->renderPartial('/projeto/financeiro/_orcamento', array('projeto'=>$model))?>
					</div>
						
					<div class="tab-pane" id="info-recebimentos">
						<?php $this->renderPartial('/projeto/financeiro/_recebimentos', array('projeto'=>$model))?>
					</div>
					
					<div class="tab-pane active" id="info-despesas">
						<?php 
							$dataRubricas = array();
							foreach($model->getRubricas() as $rubrica) $dataRubricas[$rubrica['cod_rubrica']] = $rubrica['nome'];

							$dataRubricas =  CHtml::listData(Rubrica::model()->findAll(), 'cod_rubrica', 'nome');
						
							echo CHtml::dropDownList('TipoDespesa', null, $dataRubricas, array('id'=>'tipodespesa', 'class'=>'input-xxlarge', 'prompt'=>'Selecione uma Rubrica'));
						?>
						<div id="lista-despesas">							
						</div>
						<?php $this->renderPartial('/projeto/financeiro/_despesas', array('despesas'=>$despesas, 'projeto'=>$model)) ?>
					</div>
					
					<div class="tab-pane" id="info-patrimonios">
						<?php $this->renderPartial('/projeto/financeiro/_patrimonios', array('despesas'=>$despesas))?>
					</div>
				</div><!-- /tab-content -->
			</div> <!-- /tabela_detalhes -->
		</div>
	</div> <!-- Fim Tab Tabela -->

	
	
	<div class="tab-pane" id="view-charts">
			<div class="navbar">
			<div class="navbar-inner">
			    <ul class="nav">
			      <li><?php echo CHtml::link('<i class="icon icon-plus"></i> Adicionar Receita' ,array('/projetoVerba/create','id'=>$model->cod_projeto))?></li>
			      <li><?php echo CHtml::link('<i class="icon icon-plus"></i> Adicionar Despesa' ,array('/projetoDespesa/create','id'=>$model->cod_projeto))?></li>
			    </ul>
			    <div class="btn-group">
					<a class="btn dropdown-toggle link" data-toggle="dropdown" href="#">
						Gerenciar Rubricas <span class="caret"></span>
					</a>
				  	<ul class="dropdown-menu">
				    	<li><?php echo CHtml::link('<i class="icon icon-plus"></i> Adicionar Rubrica' ,array('/rubrica/create'), array('class'=>'link'))?></li>
				      	<li><?php echo CHtml::link('<i class="icon icon-search"></i> Visualizar Rubricas' ,array('/rubrica/'), array('class'=>'link'))?></li>
				  	</ul>
			  </div>
		  	</div>
		</div>
		

<div class="view">

<h3>Balanço Financeiro do Projeto</h3>
<div class="bar_chart span12" 
		id="projeto-<?php echo $model->cod_projeto; ?>"
		data-orcamentado="<?php echo $model->verba_orcamentada;?>"
		data-recebido="<?php echo $model->verba_recebida; ?>" 
		data-gasto-comprometido="<?php echo $model->gasto_comprometido; ?>" 
		data-gasto-corrente="<?php echo $model->gasto_corrente; ?>"
		data-saldo-disponivel="<?php echo $model->saldo_disponivel; ?>"
		data-saldo-corrente="<?php echo $model->saldo_corrente; ?>"
		data-verba-compartilhada="false"
		
		
		data-rubrica="Total"
		><?php echo $model->nome;?></div>
		
		
	
		<div class="chart-table">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Orçamentado</th>
						<th>Recebido</th>
						<th>Gastos Comprometidos</th>
						<th>Gastos Correntes</th>
						<th>Saldo Disponível</th>
						<th>Saldo Corrente</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td>R$ <?php echo number_format($model->verba_orcamentada, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($model->verba_recebida, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($model->gasto_comprometido, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($model->gasto_corrente, 2, ',','.');?></td>
					<td>R$ <?php echo number_format($model->saldo_disponivel, 2, ',','.'); //Saldo Disponivel?></td>
					<td>R$ <?php echo number_format($model->saldo_corrente, 2, ',','.'); //Saldo Corrente?></td>
				</tr>
				</tbody>
			</table>
		</div>	<!-- /table -->
	
	</div> <!-- /view -->
	<br><hr>
	<h3>Balanço Financeiro do Projeto por Rubrica</h3>
	 <div id="charts" class="view">
	 	<?php $this->renderPartial('/projeto/financeiro/_info_rubrica', array('model'=>$model))?>
	 </div> <!-- /charts -->
	 
	 <br><hr>
	 <h3>Balanço Geral de Gastos</h3>
	 <div class="row">
	 	<div id="pie_chart" class="span12"></div>
	 </div>
	</div> <!-- Fim tab  Graficos -->


	<div class="tab-pane" id="view-resumo">
		<?php $this->renderPartial('_view_financeiro_resumo', array('model'=>$model)); ?>
	</div>
</div>
</div>

<!-- Modal -->
<div id="modal-info"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
  <div class="modal-body">
  <i class="icon icon-refresh"></i> Carregando...
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>