<div class="view">

	<?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_pessoa)); ?>
	<br />

<br>
<?php if(count($data->pessoa_financeiro) > 0):?>
<p><b>Informações Financeiras</b></p>
<?php endif;?>

<?php foreach ($data->pessoa_financeiro as $bolsa ):?>

<!-- Nome da Bolsa -->
<?php $categoria = $bolsa->categoria; ?>
<br>

<!-- Informações da Bolsa -->
<?php $fontePagadora = FontePagadora::model()->findByPk($bolsa->cod_fonte_pagadora)->nome?>
<b> <?php echo CHtml::link(CHtml::encode($categoria .' - '.$fontePagadora), array('/pessoaFinanceiro/view', 'id'=>$bolsa->cod_financeiro))?></b>

( <?php echo date("Y-m-d",strtotime($bolsa->data_inicio)); ?> a <?php echo date("Y-m-d",strtotime($bolsa->data_fim)); ?> )
<?php $projetoVinculado = Projeto::model()->findByPk($bolsa->projeto_vinculado); ?>
<?php if(is_object($projetoVinculado)):?>
<br><ul><li><b>Projeto Vinculado: </b><?php echo CHtml::link(CHtml::encode($projetoVinculado->nome), array('/projeto/view', 'id'=>$bolsa->projeto_vinculado))?></li></ul>
<?php endif;?>
<?php endforeach;?>

</div>

