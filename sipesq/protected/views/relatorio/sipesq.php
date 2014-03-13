<?php 
/* @var $this ProjetoController */
/* @var $model Projeto */
$url_financeiro = $this->createUrl('/relatorio/morrisFinanceiro');
$url_sipesq = $this->createUrl('/relatorio/morrisSipesq');
$url_atividades = $this->createUrl('/relatorio/morrisAtividades');
$baseUrl = Yii::app()->baseUrl;// .'/js/morris/';
Yii::app()->clientScript->registerScriptFile("{$baseUrl}/js/morris/raphael-min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile("{$baseUrl}/js/morris/morris-0.4.3.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile("{$baseUrl}/js/morris/morris-0.4.3.min.css");


Yii::app()->clientScript->registerScript('morris',"

    $.getJSON('{$url_financeiro}', function(data){

        Morris.Line({
          element: 'morris-financeiro',
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

    $.getJSON('{$url_sipesq}', function(data){

            Morris.Bar({
              element: 'morris-sipesq',
              data: data,
              xkey: 'sipesq',
              ykeys: ['p_elaboracao', 'p_negociacao','p_tramitacao', 'p_andamento', 'p_prestacao', 'p_encerrado', 'p_cancelado'],
              labels: ['Elaboração', 'Negociação', 'Tramitação', 'Andamento', 'Prestação de Contas', 'Encerrado', 'Cancelado'],
              xLabels: ['SIPESQ'],
              parseTime: false,                
            });

        });

     $.getJSON('{$url_atividades}', function(data){

            Morris.Line({
              element: 'morris-atividades',
              data: data,
              xkey: 'year',
              ykeys: ['criadas', 'finalizadas'],
              labels: ['Atividades Criadas', 'Atividades Finalizadas'],
              xLabels: ['Ano'],
              parseTime: false,     
              lineColors: ['#0480be', '#468847'],           
            });

        });
    

");
?>


<?php
$this->breadcrumbs=array(
	'Relatório de SIPESQ',
);

$this->menu=array(
	array('label'=>'Relatório de Atividades', 'url'=>array('atividade')),
	array('label'=>'Relatório de Projetos', 'url'=>array('projeto')),
  array('label'=>'Relatório do SIPESQ', 'url'=>array('sipesq')),
);
?>

<h3>Carteira de Projetos</h3>
<div id="morris-sipesq"></div>

<h3>Balanço Financeiro</h3>
<div id="morris-financeiro"></div>

<h3>Balanço de Atividades</h3>
<div id="morris-atividades"></div>

<?php 
$rubricas = Rubrica::model()->findAll(array('order'=>'nome'));

?>

<table class="table table-bordered">
<?php foreach($rubricas as $rubrica): ?>
  <tr align="center">
   <td><h3><?php echo $rubrica->nome; ?></h3></td>
   <tr><td>
  <table class="table table-striped table-hover table-condensed">
    <tr>
      <th>Projeto</th><th>Início</th><th>Fim</th><th>Recebido</th><th>Gasto</th><th>Saldo</th>
    </tr>
  <?php foreach($rubrica->receitas as $receita): ?>
  <tr class="<?php echo $receita->gasto > $receita->recebido ? 'error' : '' ?>">
    <td><?php echo $receita->projeto->nome ?></td> 
    <td><?php echo date('M/Y', strtotime($receita->projeto->data_inicio)) ?></td>
    <td><?php echo date('M/Y', strtotime($receita->projeto->data_fim)) ?></td>
    <td><?php echo number_format($receita->recebido,2,',','.') ?></td>
    <td><?php echo number_format($receita->gasto,2,',','.') ?></td>
    <td><?php echo number_format($receita->recebido - $receita->gasto,2,',','.') ?></td>
  </tr>
  <?php endforeach;?>
  </tr></table></td></tr>
<?php endforeach;?>
</table>

