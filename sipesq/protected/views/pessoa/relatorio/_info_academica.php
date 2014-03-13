<br/>
<b>Informações Acadêmicas</b>
<div class="view">

<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cartao_ufrgs')); ?>:</b>
<?php echo CHtml::encode($pessoa->cartao_ufrgs); ?>
<br />

<b><?php echo CHtml::encode("Projetos em que atua"); ?>:</b>
<?php for($i=0; $i< count($pessoa->projetos_atuante);$i++):?>
	<?php echo CHtml::link(CHtml::encode($pessoa->projetos_atuante[$i]->nome),array('/projeto/view', 'id'=>$pessoa->projetos_atuante[$i]->cod_projeto)); if($i < count($pessoa->projetos_atuante	) -1) echo ","?>
<?php endfor;?>
<br />

<?php if(isset($pessoa->categoria)):?>
	<b><?php echo CHtml::encode($pessoa->getAttributeLabel('categoria')); ?>:</b>
	<?php echo CHtml::encode($pessoa->categoria->nome); ?>
	<br />
<?php endif;?>


<b><?php echo CHtml::encode($pessoa->getAttributeLabel('lattes')); ?>:</b>
<b><?php echo CHtml::link(CHtml::encode($pessoa->lattes), $pessoa->lattes, array('target'=>'_blank')); ?></b>
<br />


<?php if(isset($pessoa->cod_vinculo_institucional)):?>
<b><?php echo CHtml::encode($pessoa->getAttributeLabel('cod_vinculo_institucional')); ?>:</b>
<?php echo CHtml::encode($pessoa->vinculo_institucional->nome); ?>
<?php endif;?>
</div> <!-- Informa��es Acad�micas -->