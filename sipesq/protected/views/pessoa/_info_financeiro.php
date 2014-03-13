<?php foreach ($data->pessoa_financeiro as $bolsa ):?>

<div class="<?php echo $bolsa->class ?>">

<?php $this->renderPartial("/projeto/_detalhe_pagamento", array('pagamento'=>$bolsa));?>
<!-- Nome da Bolsa -->
<?php $categoria = $bolsa->categoria; ?>
<br>
<!-- Informações da Bolsa -->

<b> <?php echo CHtml::link(CHtml::encode($categoria), array('/pessoafinanceiro/view', 'id'=>$bolsa->cod_financeiro))?></b>
<?php $projetoVinculado = Projeto::model()->findByPk($bolsa->projeto_vinculado); ?>
<?php if(is_object($projetoVinculado)):?>
<br>
<ul>
	<?php $fontePagadora = FontePagadora::model()->findByPk($bolsa->cod_fonte_pagadora)->nome?>
	<li><b>Projeto Vinculado: </b><?php echo CHtml::link(CHtml::encode($projetoVinculado->nome), array('/projeto/view', 'id'=>$bolsa->projeto_vinculado))?></li>
	<li><b>Fonte Pagadora: </b><?php echo $fontePagadora;?></li>
	<li><b>Período: </b><?php echo $bolsa->vigencia ." meses, ".$bolsa->data_inicio?> a <?php echo $bolsa->data_fim ?></li>
	<li><b>Valor Mensal:</b> <?php echo  number_format($bolsa->valor,2,',','.');?></li>
	<li><b>Total Recebido no Período: </b> <?php echo number_format($bolsa->valor_total,2,',','.');?></li>
</ul>
<?php endif;?>
</div>

<?php endforeach;?>



