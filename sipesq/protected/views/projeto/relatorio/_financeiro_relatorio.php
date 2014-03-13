<?php 
/* @var $this ProjetoController */
/* @var $model Projeto */

Yii::app()->clientScript->registerScriptFile("https://www.google.com/jsapi", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl ."/js/charts.js", CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl .'/css/arvoredespesas.css');

$criteria = new CDbCriteria();
$criteria->with = 'receitas';
$criteria->compare('receitas.cod_projeto', $model->cod_projeto);
$criteria->together = true;
//$criteria->addCondition('cod_rubrica_pai is NULL');

$rubricas = Rubrica::model()->findAll($criteria);

$receitas = $model->receitas;//ProjetoVerba::model()->with('rubrica')->findAll(array('condition'=>'cod_projeto = :projeto', 'order'=>'t.cod_verba', 'params'=>array('projeto'=>$model->cod_projeto)));

$despesas = array();
foreach($model->receitas as $rec){
	foreach ($rec->despesas as $desp){
		$despesas[] = $desp;
	}
}
?>

<div class="row-fluid">

<h5>Balanço financeiro do projeto</h5>
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
		<table class="table table-striped table-hover">
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


<div id="tabela-financeiro">

	<div  class="tabela_detalhes" >
		<br />
		<h4>Orçamentos</h4>
		<br />
		<?php $this->renderPartial('/projeto/relatorio/_orcamento', array('projeto'=>$model))?>
		<h4>Receitas</h4>
		<?php $this->renderPartial('/projeto/relatorio/_recebimentos', array('projeto'=>$model))?>
		<h4>Despesas</h4>
		<?php $this->renderPartial('/projeto/relatorio/_despesas', array('despesas'=>$despesas, 'projeto'=>$model))?>
		<h4>Patrimônios</h4>
		<div id="patrimonios">
			<?php $this->renderPartial('/projeto/relatorio/_patrimonios', array('despesas'=>$despesas))?>
		</div>
		
			
	</div> <!-- /tabela_detalhes -->
</div>

</div> <!-- /view -->
<br><hr>
<div class="row-fluid">
	<div class="span12">
		<h2>Balanço Financeiro do Projeto por Rubrica</h2>
	 	<div id="charts"><?php $this->renderPartial('/projeto/financeiro/_info_rubrica', array('model'=>$model))?></div>
	</div>
</div>
