<?php 
$val = 32/12;

$frac = $val - floor($val);

$dia = 12;
$mes = 12;
$ano = 2010;

echo "Data Antiga: 12/12/2010<br>";
function somaMes($data, $meses){
	$data = strtotime($data);
	$dia = date("d", $data);
	$mes_atual = date("m", $data);
	$ano = date("Y", $data);
	
	$novoMes = $mes_atual + $meses;
	
	if($novoMes > 12){
		$val  = $novoMes / 12;
		$novo_ano = $ano  + floor($val);
		$novo_mes =  floor(($val - floor($val)) * $mes_atual);
	}
	return $dia .'/' .$novo_mes .'/' .$novo_ano;
}

$novaData = somaMes('12/12/2010', 12);
echo "Nova Data: \n";
echo $novaData;
echo "<hr>";

$newData = date("d/m/Y", mktime(0, 0, 0, $mes + 13,
     $dia, $ano) );
     echo $newData;