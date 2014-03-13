<?php
$pagina = Configuracoes::model()->findByPk(2);
$this->pageTitle=Yii::app()->name . ' - ' .$pagina->titulo;
$this->breadcrumbs=array(
	'Sobre',
);

echo $pagina->conteudo;

?>
