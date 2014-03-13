<?php /* @var PermissaoAtividadeForm $acervo */?>
<h4>Permissões da Página de Acervo</h4>
<div class="input">
	<?php echo $form->labelEx($acervo,'livros'); ?>
	<?php echo $form->dropDownList($acervo, 'livros', Grupo::binaryPermitions());?>
	<?php echo $form->error($acervo,'livros'); ?>
</div>

<div class="input">
	<?php echo $form->labelEx($acervo,'links'); ?>
	<?php echo $form->dropDownList($acervo, 'links', Grupo::binaryPermitions());?>
	<?php echo $form->error($acervo,'links'); ?>
</div>

<div class="input">
	<?php echo $form->labelEx($acervo,'subscriptions'); ?>
	<?php echo $form->dropDownList($acervo, 'subscriptions', Grupo::binaryPermitions());?>
	<?php echo $form->error($acervo,'subscriptions'); ?>
</div>

<div class="input">
	<?php echo $form->labelEx($acervo,'contatos'); ?>
	<?php echo $form->dropDownList($acervo, 'contatos', Grupo::binaryPermitions());?>
	<?php echo $form->error($acervo,'contatos'); ?>
</div>