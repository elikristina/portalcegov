<?php
/** Error reporting */
error_reporting(E_ALL);


/*
* Para que funcione o Autoloader do PHPExcel, preciso
* desregistrar o autoloader do YII, incluir o PHPExcel
* e então registrar novamente o autoloader do Yii.
* Com isso, o autoloader do PHPExcel fica na frente do YII.
* Como o do PHPExcel retorna falso caso não consiga achar a classe
* e o Yii gera uma exceção, a ordem deve ser essa.
*/
// unregister Yii's autoloader
spl_autoload_unregister(array('YiiBase', 'autoload'));
// register PHPExcel's autoloader ... PHPExcel.php will do it
$phpExcelPath = Yii::getPathOfAlias('ext.phpexcel');
include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');
// register Yii's autoloader again
spl_autoload_register(array('YiiBase', 'autoload'));

// This requires PHPExcel's autoloader
$objReader = PHPExcel_IOFactory::createReader('Excel5');

// Create new PHPExcel object
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

if (!file_exists("./files/modelo_relatorio_bolsas.xlsx")) {
	exit("Não existe um modelo. Faça upload de um arquivo modelo antes." . EOL);
}

//carrega o modelo
$objPHPExcel = PHPExcel_IOFactory::load("./files/modelo_relatorio_bolsas.xlsx");
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setPreCalculateFormulas(false);

// Set properties
$objPHPExcel->getProperties()->setCreator("Cegov");
$objPHPExcel->getProperties()->setLastModifiedBy("Cegov");
$objPHPExcel->getProperties()->setTitle("Relatorio de Bolsas");
$objPHPExcel->getProperties()->setDescription("Relatorio de Bolsas do Projeto");

$objPHPExcel->setActiveSheetIndex(0);

//Descobre qual das bolsas tem a data mais recente e mais antiga, pra adicionar o numero certo de colunas
$maisRecente = "0";
$maisAntigo = "3000-12-31";
foreach ($model as $projeto){
	foreach ($projeto->pessoas_recebimento as $bolsa){
		if($bolsa->cod_categoria != 3) //se nÃ£o for serviÃ§o
		{
			if(strcmp($maisAntigo, $bolsa->data_inicio) > 0)
				$maisAntigo = $bolsa->data_inicio;
	
			if(strcmp($maisRecente, $bolsa->data_fim) < 0)
				$maisRecente = $bolsa->data_fim;
		}
	}
}
$colunasInseridas = 0;

//adiciona o numero certo de colunas e já coloca o mes e ano no cabeçalho, além da célula de soma no fim
//Se não adicionar as colunas, deve ficar mais rapido!
$maisAntigo = preg_split("/-/", $maisAntigo);
$maisRecente = preg_split("/-/", $maisRecente);
for ($i = ($maisRecente[0]*12)+$maisRecente[1];$i>($maisAntigo[0]*12)+$maisAntigo[1]-1;$i--){
	$mes = $i % 12;
	$ano = floor($i/12);
	$objPHPExcel->getActiveSheet()->insertNewColumnBefore('E',1);
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(4,3,($mes+1).'/'.$ano);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
	$colunasInseridas++;
}

//$objPHPExcel->getActiveSheet()->insertNewRowBefore(5,10);
//Adiciona uma linha por pessoa, e preenche a linha com o nome, a vigencia e o que foi/vai ser recebido

$j = 0;
foreach ($model as $projeto){
	foreach ($projeto->pessoas_recebimento as $bolsa){
		if($bolsa->cod_categoria != 3) //se nÃ£o for serviÃ§o
		{
			//insere a vigencia
			$data_inicio = preg_split("/-/", $bolsa->data_inicio);
			$data_fim = preg_split("/-/", $bolsa->data_fim);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(1,4+$j,$data_inicio[2].'/'.$data_inicio[1].'/'.$data_inicio[0]);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(2,4+$j,$data_fim[2].'/'.$data_fim[1].'/'.$data_fim[0]);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($colunasInseridas+4,4+$j, $data_fim[0]*12+$data_fim[1]);
			
			//insere o nome da pessoa e do projeto
			$pessoa = Pessoa::model()->findByPk($bolsa->cod_pessoa);
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,4+$j,$pessoa->nome);
			
			//copia a formatação condicional do nome do primeiro pros outros
			$conditionalStyles = $objPHPExcel->getActiveSheet()->getConditionalStyles("A4");
			$styleArray = array();
			$colunaFimDaBolsa = PHPExcel_Cell::stringFromColumnIndex(4+$colunasInseridas);
			foreach ($conditionalStyles as $style)
			{
				$estilo = clone $style;
				if($j==0){
					array_push($styleArray, $estilo->setCondition(str_replace(
					"E4", $colunaFimDaBolsa.(4+$j), 
					$estilo->getCondition())));
				}else{
					array_push($styleArray, $estilo->setCondition(str_replace(
					($colunaFimDaBolsa."4"), $colunaFimDaBolsa.(4+$j), 
					$estilo->getCondition())));
				}
				//$objPHPExcel->getActiveSheet()->setCellValue("A1", $style->getCondition());
			}
			$objPHPExcel->getActiveSheet()->setConditionalStyles("A".(4+$j), $styleArray);
			
			//$condition->
					
			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(3,4+$j,$projeto->nome_curto);
			
			//insere os pagamentos por mes
			$colunaInicio = 4 + ($data_inicio[0] - $maisAntigo[0])*12 + $data_inicio[1] - $maisAntigo[1];
			$colunaFim = 4 + ($data_fim[0] - $maisAntigo[0])*12 + $data_fim[1] - $maisAntigo[1];
			for($i=$colunaInicio; $i<=$colunaFim; $i++){
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i,4+$j,$bolsa->valor);
			}
			
			//insere as celulas calculadas pra
			
			$j++;
		}
	}
}
$quantidadePessoas=$j;
$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(0,$quantidadePessoas+4,"SOMA TOTAL");
for ($i=0;$i<(($maisRecente[0]*12)+$maisRecente[1]) - (($maisAntigo[0]*12)+$maisAntigo[1]);$i++){
	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i+4,$quantidadePessoas+4,"=SUM(E4:E" . ($quantidadePessoas +3) . ")");
}


$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);

$objPHPExcel->getActiveSheet()->setSharedStyle($objPHPExcel->getActiveSheet()->getStyle('A4'), 'B4:'.
		$objPHPExcel->getActiveSheet()->getHighestColumn().
		$objPHPExcel->getActiveSheet()->getHighestRow());
$objPHPExcel->getActiveSheet()->setSharedStyle($objPHPExcel->getActiveSheet()->getStyle('A4'), 'A5:A'.
		$objPHPExcel->getActiveSheet()->getHighestRow());
$objPHPExcel->getActiveSheet()->getColumnDimension($objPHPExcel->getActiveSheet()->getHighestColumn())->setVisible(false);

$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(3,4);

$objPHPExcel->getActiveSheet()->setTitle('Bolsas');



// Save Excel 2007 file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

$objWriter->save('php://output');
?>