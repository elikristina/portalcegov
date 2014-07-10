<div class="form well well-large">
	<div class="row-fluid">
		<div class="span2">
			<h4>Dados Pessoais</h4>
		</div>
		<div class="span10">
			<div class="row-fluid">	
				<div class="span6">
					<?php echo $form->labelEx($model,'nome'); ?>
					<?php echo $form->textField($model,'nome', array('size'=>'65', 'class'=>'span12')); ?>
					<?php echo $form->error($model,'nome'); ?>
				</div>
				<div class="span6">
					<?php echo $form->labelEx($model,'nome_mae'); ?>
					<?php echo $form->textField($model,'nome_mae', array('size'=>'65', 'class'=>'span12')); ?>
					<?php echo $form->error($model,'nome_mae'); ?>
				</div>
			</div>

			<div class="row-fluid">
				<div class="span3">
					<?php echo $form->labelEx($model,'cpf'); ?>
					<?php echo $form->textField($model,'cpf', array('size'=>'65', 'pattern'=>"\d{3}\.?\d{3}\.?\d{3}\-?\d{2}", 'placeholder'=>"Somente números", 'class'=>'span12')); ?>
					<?php echo $form->error($model,'cpf'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'rg'); ?>
					<?php echo $form->textField($model,'rg', array('size'=>'65', 'pattern'=>"\w+", 'placeholder'=>"Somente números", 'class'=>'span12')); ?>
					<?php echo $form->error($model,'rg'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'orgao_expedidor'); ?>
					<?php echo $form->textField($model,'orgao_expedidor', array('size'=>'20', 'class'=>'span12')); ?>
					<?php echo $form->error($model,'orgao_expedidor'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($model,'data_nascimento'); ?>
					<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			    			'name'=>'Pessoa[data_nascimento]',
							'value'=>isset($model->data_nascimento) ? date($model->data_nascimento) : date('d/m/Y', strtotime("1980-01-01")),
							'language'=>'pt-BR',
			    			'options'=>array('showAnim'=>'fadeIn', 'changeMonth'=>true, 'changeYear'=>true, 'yearRange'=>'1900:2014', 'dateFormat'=>'dd/mm/yy'),
						    'htmlOptions'=>array('class'=>'span12'),));
					 ?>
					<?php echo $form->error($model,'data_nascimento'); ?>
				</div>
			</div>
		</div>
	</div>

	<hr>
	<div class="row-fluid">
		<div class="span2">
			<h4>Contato</h4>
		</div>
		<div class="span10">	
			<div class="span6">
				<?php echo $form->labelEx($model,'email'); ?>
				<?php echo $form->textField($model,'email', array('type'=>'email', 'size'=>'65' , 'class'=>'span12')); ?>
				<?php echo $form->error($model,'email'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'telefone'); ?>
				<?php echo $form->textField($model,'telefone', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'Somente números', 'class'=>'span12')); ?>
				<?php echo $form->error($model,'telefone'); ?>
			</div>
			<div class="span3">
				<?php echo $form->labelEx($model,'celular'); ?>
				<?php echo $form->textField($model,'celular', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'Somente números', 'class'=>'span12')); ?>
				<?php echo $form->error($model,'celular'); ?>
			</div>
		</div>
	</div>

	<hr>

	<div class="row-fluid">
		<div class="span2">
			<h4>Endereço Residencial</h4>
			<?php echo $form->hiddenField($endereco_res,'tipo', array('size'=>65, 'placeholder'=>'Residencial', 'class'=>'span12', 'value'=>'residencial')); ?>
			<?php echo $form->error($endereco_res,'tipo'); ?>
		</div>
		<div class="span10">
			<div class="row-fluid">
				<div class="span2">
					<?php echo $form->labelEx($endereco_res,'cep'); ?>
					<?php echo $form->textField($endereco_res,'cep', array('size'=>65, 'placeholder'=>'91509-900', 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'cep'); ?>
				</div>
				<div class="span8">
					<?php echo $form->labelEx($endereco_res,'logradouro'); ?>
					<?php echo $form->textField($endereco_res,'logradouro', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'logradouro'); ?>
				</div>
				<div class="span2">
					<?php echo $form->labelEx($endereco_res,'numero'); ?>
					<?php echo $form->textField($endereco_res,'numero', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'numero'); ?>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span3">
					<?php echo $form->labelEx($endereco_res,'complemento'); ?>
					<?php echo $form->textField($endereco_res,'complemento', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'complemento'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($endereco_res,'bairro'); ?>
					<?php echo $form->textField($endereco_res,'bairro', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'bairro'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($endereco_res,'cidade'); ?>
					<?php echo $form->textField($endereco_res,'cidade', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'cidade'); ?>
				</div>
				<div class="span3">
					<?php echo $form->labelEx($endereco_res,'pais'); ?>
					<?php echo $form->textField($endereco_res,'pais', array('size'=>65, 'class'=>'span12')); ?>
					<?php echo $form->error($endereco_res,'pais'); ?>
				</div>
			</div>
		</div>
	</div>
<?php /*	
 <?php if($model->isNewRecord):?>
	<div class="form-row">
		<?php echo $form->labelEx($model,'senha'); ?>
		<?php echo $form->passwordField($model,'senha', array('size'=>'65')); ?>
		<?php echo $form->error($model,'senha'); ?>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'senha_confirm'); ?>
		<?php echo $form->passwordField($model,'senha_confirm', array('size'=>'65')); ?>
		<?php echo $form->error($model,'senha_confirm'); ?>
	</div>
<?php endif;?>
*/?>
</div>
	


	



