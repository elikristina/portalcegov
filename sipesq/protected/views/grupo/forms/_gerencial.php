<?php /* @var PermissaoAtividadeForm $gerencial */?>

<h4>Permissões da Página Gerencial</h4>
<div class="input">
	<?php echo $form->labelEx($gerencial,'rubricas'); ?>
	<?php echo $form->dropDownList($gerencial, 'rubricas', Grupo::binaryPermitions());?>
	<?php echo $form->error($gerencial,'rubricas'); ?>
</div>
<div class="input">
	<?php echo $form->labelEx($gerencial,'categoria_atividade'); ?>
	<?php echo $form->dropDownList($gerencial, 'categoria_atividade', Grupo::binaryPermitions());?>
	<?php echo $form->error($gerencial,'categoria_atividade'); ?>
</div>
<div class="input">
	<?php echo $form->labelEx($gerencial,'permissoes'); ?>
	<?php echo $form->dropDownList($gerencial, 'permissoes', Grupo::binaryPermitions());?>
	<?php echo $form->error($gerencial,'permissoes'); ?>
</div>
<div class="input">
	<?php echo $form->labelEx($gerencial,'relatorios'); ?>
	<?php echo $form->dropDownList($gerencial, 'relatorios', Grupo::binaryPermitions());?>
	<?php echo $form->error($gerencial,'relatorios'); ?>
</div>
