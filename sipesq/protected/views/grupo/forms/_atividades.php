<?php /* @var PermissaoAtividadeForm $atividade */?>
<h4>Permissões da Página de Atividades</h4>
<div class="input">
	<?php echo $form->labelEx($atividade,'informacoes'); ?>
	<?php echo $form->dropDownList($atividade, 'informacoes', Grupo::defaultPermitions());?>
	<?php echo $form->error($atividade,'informacoes'); ?>
</div>
<div class="input">
	<?php echo $form->labelEx($atividade,'deletar'); ?>
	<?php echo $form->dropDownList($atividade, 'deletar', Grupo::binaryPermitions());?>
	<?php echo $form->error($atividade,'deletar'); ?>
</div>
