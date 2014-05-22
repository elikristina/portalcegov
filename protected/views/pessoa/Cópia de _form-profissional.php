<div class="form well well-large">

<div class="row-fluid">
	<div class="span2">
		<?php echo $form->labelEx($model,'tipo'); ?>
		<?php echo $form->hiddenField($model,'tipo', array('size'=>65, 'placeholder'=>'Residencial', 'class'=>'span12',)); ?>
		<?php echo $form->error($model,'tipo'); ?>
	</div>
	<div class="span2">
		<?php echo $form->labelEx($model,'cep'); ?>
		<?php echo $form->textField($model,'cep', array('size'=>65, 'placeholder'=>'91509-900', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'cep'); ?>
	</div>
	<div class="span6">
		<?php echo $form->labelEx($model,'logradouro'); ?>
		<?php echo $form->textField($model,'logradouro', array('size'=>65, 'placeholder'=>'Rua das Alamedas, 305', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'logradouro'); ?>
	</div>
	<div class="span2">
		<?php echo $form->labelEx($model,'numero'); ?>
		<?php echo $form->textField($model,'numero', array('size'=>65, 'placeholder'=>'9500', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'numero'); ?>
	</div>
</div>
<div class="row-fluid">
	<div class="span3">
		<?php echo $form->labelEx($model,'complemento'); ?>
		<?php echo $form->textField($model,'complemento', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'complemento'); ?>
	</div>
	<div class="span3">
		<?php echo $form->labelEx($model,'bairro'); ?>
		<?php echo $form->textField($model,'bairro', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'bairro'); ?>
	</div>
	<div class="span3">
		<?php echo $form->labelEx($model,'cidade'); ?>
		<?php echo $form->textField($model,'cidade', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'cidade'); ?>
	</div>
	<div class="span3">
		<?php echo $form->labelEx($model,'pais'); ?>
		<?php echo $form->textField($model,'pais', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'pais'); ?>
	</div>

</div>


</div><!-- form -->


