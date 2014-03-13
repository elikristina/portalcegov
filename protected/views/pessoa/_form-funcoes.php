
<div class="form well well-small">

<?php 
Yii::app()->clientScript->registerScriptFile("//tinymce.cachefly.net/4.0/tinymce.min.js");
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({

								selector: '.tinyMceEditor',
								theme : 'modern',
								plugins: 'link, preview, media, image, code, fullscreen, nonbreaking, table, charmap',
								menubar: 'false',
								toolbar: 'formatselect | fontsizeselect | alignleft aligncenter alignright alignjustify | removeformat | bold italic underline strikethrough subscript superscript | cut copy paste | hr charmap table | bullist numlist | outdent indent | undo redo | image media link | fullscreen preview code', 
								statusbar: false,
								image_advtab: true,
								nonbreaking_force_tab: true,
								width: '100%',
        						height: '300'
							});
	");


Yii::app()->clientScript->registerScript('multiple-select',"

	$(\"select[multiple]\").bind(\"mousedown\", function(e) {
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		});
  		
	$(document).ready(
	function(){
	$('#datepicker').datepicker({
					inline: true
				});
	}
	
	);				
");



?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pessoa-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Campos com <span class="required">*</span> são obrigatórios.</p>
<br/>
	<?php echo $form->errorSummary($model); ?>

<div class="row-fluid">
<div class="span6">

	<div class="form-row">
		<?php echo $form->labelEx($model,'nome_sobrenome'); ?>
		<?php echo $form->textField($model,'nome', array('size'=>'65', 'placeholder'=>"Nome e Sobrenome. Ex: João da Silva", 'class'=>'span12')); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>


	<div class="form-row">
		<div class="span4">
		<?php echo $form->labelEx($model,'CPF'); ?>
		<?php echo $form->textField($model,'CPF', array('size'=>'65', 'pattern'=>"\d{3}\.?\d{3}\.?\d{3}\-?\d{2}", 'placeholder'=>"Somente números", 'class'=>'span12')); ?>
		<?php echo $form->error($model,'CPF'); ?>
	</div>
	<div class="span4">
		<?php echo $form->labelEx($model,'RG'); ?>
		<?php echo $form->textField($model,'RG', array('size'=>'65', 'pattern'=>"\w+", 'placeholder'=>"Somente números", 'class'=>'span12')); ?>
		<?php echo $form->error($model,'RG'); ?>
		</div>
		<div class="span4">
		<?php echo $form->labelEx($model,'passaporte'); ?>
		<?php echo $form->textField($model,'RG', array('size'=>'65', 'pattern'=>"\w+", 'placeholder'=>"Estrangeiros", 'class'=>'span12', 'disabled'=>'disabled')); ?>
		<?php echo $form->error($model,'RG'); ?>
		</div>
		
	</div>
	
	<div class="form-row">
		
		<div class="span5">
		<?php echo $form->labelEx($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'55513333-2222', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'telefone'); ?>
		</div>
		<div class="span5">
			<?php echo $form->labelEx($model,'celular'); ?>
			<?php echo $form->textField($model,'celular', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'55519999-8888', 'class'=>'span12')); ?>
			<?php echo $form->error($model,'celular'); ?>
		</div>
		<div class="span2">
			<?php echo $form->labelEx($model,'Ramal'); ?>
			<?php echo $form->textField($model,'celular', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'1234', 'class'=>'span12', 'disabled'=>'disabled')); ?>
			<?php echo $form->error($model,'celular'); ?>
		</div>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'CPF'); ?>
		<?php echo $form->textField($model,'CPF', array('size'=>'65', 'pattern'=>"\d{3}\.?\d{3}\.?\d{3}\-?\d{2}", 'placeholder'=>"xxx.xxx.xxx-xx ou xxxxxxxxxxx")); ?>
		<?php echo $form->error($model,'CPF'); ?>
	</div>
	
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Pessoa[data_nascimento]',
				'value'=>isset($model->data_nascimento) ? date('d/m/Y', strtotime($model->data_nascimento)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'fold','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
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

	<div class="form-row">
		<?php echo $form->labelEx($model,'lattes'); ?>
		<?php echo $form->textField($model,'lattes', array('size'=>65, 'type'=>'url', 'placeholder'=>'Ex: http://lattes.cnpq.br/222222222', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'lattes'); ?>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'instituicao'); ?>
		<?php echo $form->textField($model,'instituicao', array('size'=>65, 'placeholder'=>"Ex: UFRGS, PUCRS, etc")); ?>
		<?php echo $form->error($model,'instituicao'); ?>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'cartao_ufrgs'); ?>
		<?php echo $form->textField($model,'cartao_ufrgs', array('pattern'=>"\d+", 'placeholder'=>"Ex: 10203040")); ?>
		<?php echo $form->error($model,'cartao_ufrgs'); ?>
	</div>
	

</div><!-- fim da coluna da esquerda -->

<div class="span6">


	<div class="form-row">
		<div class="span7">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('type'=>'email', 'size'=>'65' , 'placeholder'=>"fulano@me.com", 'class'=>'span12')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="span5">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Pessoa[data_nascimento]',
				'value'=>isset($model->data_nascimento) ? date('d/m/Y', strtotime($model->data_nascimento)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'fold','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('class'=>'span12'),));
		 ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
	</div>
	</div>


	<div class="form-row">
		<?php echo $form->labelEx($model,'nome_mae'); ?>
		<?php echo $form->textField($model,'nome_mae', array('size'=>'65', 'placeholder'=>"Nome e Sobrenome. Ex: Maria da Silva", 'class'=>'span12')); ?>
		<?php echo $form->error($model,'nome_mae'); ?>
	</div>
	

	
	<div class="form-row">
		<div class="span8">
			<?php echo $form->labelEx($model,'lattes'); ?>
			<?php echo $form->textField($model,'lattes', array('size'=>65, 'type'=>'url', 'placeholder'=>'Ex: http://lattes.cnpq.br/222222222', 'class'=>'span12')); ?>
			<?php echo $form->error($model,'lattes'); ?>
		</div>
		<div class="span4">
			<?php echo $form->labelEx($model,'cartao_ufrgs'); ?>
			<?php echo $form->textField($model,'cartao_ufrgs', array('pattern'=>"\d+", 'placeholder'=>"Ex: 10203040", 'class'=>'span12')); ?>
			<?php echo $form->error($model,'cartao_ufrgs'); ?>
		</div>

	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'celular'); ?>
		<?php echo $form->textField($model,'celular', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'55519999-8888')); ?>
		<?php echo $form->error($model,'celular'); ?>
	</div>

	<div class="form-row">
		<?php echo $form->labelEx($model,'RG'); ?>
		<?php echo $form->textField($model,'RG', array('size'=>65, 'pattern'=>"\w+", 'placeholder'=>"Ex: xxxxxx...")); ?>
		<?php echo $form->error($model,'RG'); ?>
	</div>
	
		<div class="form-row">
		<?php echo $form->labelEx($model,'pagina_pessoal'); ?>
		<?php echo $form->textField($model,'pagina_pessoal', array('type'=>'url', 'size'=>'65', 'placeholder'=>"http://www.minha-pagina.com")); ?>
		<?php echo $form->error($model,'pagina_pessoal'); ?>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'orgao_departamento'); ?>
		<?php echo $form->textField($model,'orgao_departamento', array('size'=>65, 'placeholder'=>'Ex: Escola de Administração, Instituto de Informática, etc.', 'class'=>'span12')); ?>
		<?php echo $form->error($model,'orgao_departamento'); ?>
	</div>
	
	<div class="form-row">
		<?php echo $form->labelEx($model,'endereco_profissional'); ?>
		<?php echo $form->textField($model,'endereco_profissional', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35')); ?>
		<?php echo $form->error($model,'endereco_profissional'); ?>
	</div>


</div> <!-- fim da coluna da direita -->
</div><!-- form-row-fluid -->

<hr>
<div class="row-fluid" >
	<div class="span6">
		<?php 
		$categoriasComFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'categoriaPai', 'order'=>'t.ordem', 'condition'=>'t.cod_categoria_pai is not null')), 'cod_categoria', 'nome', 'categoriaPai.nome');
		$categoriasSemFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'secundarias',  'condition'=>'secundarias is null AND t.cod_categoria_pai is null')), 'cod_categoria', 'nome', 'secundarias.nome');
		?>
		<div class="form-row">
			<?php echo $form->labelEx($model,'categorias'); ?>
			<?php  echo $form->listBox($model,'categorias', array_merge($categoriasComFilhos, $categoriasSemFilhos), array("multiple"=>"multiple", "size"=>Categoria::model()->count(), 'class'=>'span12')  ); ?>
			<?php echo $form->error($model,'categorias'); ?>
		</div>
	</div><!-- span6 -->
	
	<div class="span6">
		<div class="form-row">
			<?php echo $form->labelEx($model,'grupos'); ?>
			<?php  echo $form->listBox($model,'grupos', CHtml::listData(GrupoTrabalho::model()->findAll(array('order'=>'nome')), 'cod_gt', 'nome'), array("multiple"=>"multiple", "size"=>GrupoTrabalho::model()->count(), 'class'=>'span12')  ); ?>
			<?php echo $form->error($model,'grupos'); ?>
		</div>
	</div>
	
</div>

<hr>

<div class="row-fluid" >
	<div class="span6">
		<h4><?php echo $form->labelEx($model,'descricao'); ?></h4>
		<?php echo $form->textArea($model, 'descricao', array('class'=>'tinyMceEditor'));?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>
	<div class="span6">		
		<h4><?php echo $form->labelEx($model,'descricao_en'); ?></h4>
		<?php echo $form->textArea($model, 'descricao_en', array('class'=>'tinyMceEditor'));?>
		<?php echo $form->error($model,'descricao_en'); ?>
	</div>
</div>
<div class="row-fluid">
		<div class="form-row">
			<h4><?php echo $form->labelEx($model,'imageFile'); ?></h4>
			<?php echo $form->fileField($model,'imageFile', array('class'=>'btn btn-primary')); ?><br>
		<span class="hint">Arquivos com aspecto 1:1 e menores que 400kbytes</span>
			<?php echo $form->error($model,'imageFile'); ?>
		</div>
		
		<div class="form-row buttons">
			<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'btn btn-primary btn-small')); ?>
		</div>
	</div>
</div><!-- row fluid - descricao -->

<br>
	

<?php $this->endWidget(); ?>


</div><!-- form -->
