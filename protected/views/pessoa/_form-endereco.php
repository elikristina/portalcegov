<div class="form well well-large">

<div class="row-fluid">
	<div class="span2">
		<h4>Endereço Profissional</h4>
		<?php echo $form->hiddenField($endereco_pro,'tipo', array('size'=>65, 'placeholder'=>'Residencial', 'class'=>'span12', 'value'=>'profissional')); ?>
		<?php echo $form->error($endereco_pro,'tipo'); ?>
	</div>
	<div class="span10">
		<div class="row-fluid">
			<div class="span2">
				<?php echo $form->labelEx($endereco_pro,'cep'); ?>
				<?php echo $form->textField($endereco_pro,'cep', array('size'=>65, 'placeholder'=>'91509-900', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'cep'); ?>
			</div>
			<div class="span8">
				<?php echo $form->labelEx($endereco_pro,'logradouro'); ?>
				<?php echo $form->textField($endereco_pro,'logradouro', array('size'=>65, 'placeholder'=>'Rua das Alamedas, 305', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'logradouro'); ?>
			</div>
			<div class="span2">
				<?php echo $form->labelEx($endereco_pro,'numero'); ?>
				<?php echo $form->textField($endereco_pro,'numero', array('size'=>65, 'placeholder'=>'9500', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'numero'); ?>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3">
				<?php echo $form->labelEx($endereco_pro,'complemento'); ?>
				<?php echo $form->textField($endereco_pro,'complemento', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'complemento'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($endereco_pro,'bairro'); ?>
				<?php echo $form->textField($endereco_pro,'bairro', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'bairro'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($endereco_pro,'cidade'); ?>
				<?php echo $form->textField($endereco_pro,'cidade', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'cidade'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($endereco_pro,'pais'); ?>
				<?php echo $form->textField($endereco_pro,'pais', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
				<?php echo $form->error($endereco_pro,'pais'); ?>
			</div>
		</div>
	</div>
</div>
</div><!-- form -->


