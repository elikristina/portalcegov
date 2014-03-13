<?php

$this->pageTitle="CEGOV" . " - " .$model->titulo;
 
$this->breadcrumbs=array(
	$model->titulo,
);
?>
<h2><?php echo CHtml::encode($model->titulo);?></h2>
<div class="view"> 
<?php  
	echo $model->conteudo; 
	//Coloca Link para editar
	if(!Yii::app()->user->isGuest){
		echo "<hr>";
		echo CHtml::link("Editar Página", array("/pagina/update/" .$model->cod_pagina));
}
?>
</div>