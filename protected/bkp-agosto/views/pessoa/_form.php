<style>
.left{
	float: left;
	border-right: 1px dotted #336699;
	width: 430px;
}
.right{
	width: 450px;
	float: right;
	heigth: 100%;

}

.center{
	clear: both;
	border-top:3px solid #336699; 
	padding-top: 20px;
}
</style>

<div class="form">

<?php 

Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '500',
        						height: '150'
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

	<?php echo $form->errorSummary($model); ?>
	
<div class="left">

	<div class="row">
		<?php echo $form->labelEx($model,'nome'); ?>
		<?php echo $form->textField($model,'nome', array('size'=>'65', 'placeholder'=>"Nome e Sobrenome. Ex: João da Silva")); ?>
		<?php echo $form->error($model,'nome'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('type'=>'email', 'size'=>'65' , 'placeholder'=>"fulano@me.com")); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'orgao_expedidor'); ?>
		<?php echo $form->textField($model,'orgao_expedidor', array('size'=>'65', 'placeholder'=>"Ex: SJS, SSP, etc")); ?>
		<?php echo $form->error($model,'orgao_expedidor'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'CPF'); ?>
		<?php echo $form->textField($model,'CPF', array('size'=>'65', 'pattern'=>"\d{3}\.?\d{3}\.?\d{3}\-?\d{2}", 'placeholder'=>"xxx.xxx.xxx-xx ou xxxxxxxxxxx")); ?>
		<?php echo $form->error($model,'CPF'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'nome_mae'); ?>
		<?php echo $form->textField($model,'nome_mae', array('size'=>'65', 'placeholder'=>"Nome e Sobrenome. Ex: Maria da Silva")); ?>
		<?php echo $form->error($model,'nome_mae'); ?>
	</div>
	
<?php /*	
 <?php if($model->isNewRecord):?>
	<div class="row">
		<?php echo $form->labelEx($model,'senha'); ?>
		<?php echo $form->passwordField($model,'senha', array('size'=>'65')); ?>
		<?php echo $form->error($model,'senha'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'senha_confirm'); ?>
		<?php echo $form->passwordField($model,'senha_confirm', array('size'=>'65')); ?>
		<?php echo $form->error($model,'senha_confirm'); ?>
	</div>
<?php endif;?>
*/?>

<div class="row">
		<?php echo $form->labelEx($model,'lattes'); ?>
		<?php echo $form->textField($model,'lattes', array('size'=>65, 'type'=>'url', 'placeholder'=>'Ex: http://lattes.cnpq.br/222222222')); ?>
		<?php echo $form->error($model,'lattes'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'instituicao'); ?>
		<?php echo $form->textField($model,'instituicao', array('size'=>65, 'placeholder'=>"Ex: UFRGS, PUCRS, etc")); ?>
		<?php echo $form->error($model,'instituicao'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'cartao_ufrgs'); ?>
		<?php echo $form->textField($model,'cartao_ufrgs', array('pattern'=>"\d+", 'placeholder'=>"Ex: 10203040")); ?>
		<?php echo $form->error($model,'cartao_ufrgs'); ?>
	</div>
	

</div><!-- fim da coluna da esquerda -->

<div class="right">
	<div class="row">
		<?php echo $form->labelEx($model,'data_nascimento'); ?>
		<?php  $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Pessoa[data_nascimento]',
				'value'=>isset($model->data_nascimento) ? date('d/m/Y', strtotime($model->data_nascimento)) : date('d/m/Y'),
				'language'=>'pt-BR',
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		 ?>
		<?php echo $form->error($model,'data_nascimento'); ?>
		
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'nacionalidade'); ?>
		<?php echo $form->textField($model,'nacionalidade', array('size'=>'65', 'placeholder'=>'Brasileiro')); ?>
		<?php echo $form->error($model,'nacionalidade'); ?>
	</div>
	
	
	<div class="row">
		<?php echo $form->labelEx($model,'telefone'); ?>
		<?php echo $form->textField($model,'telefone', array('size'=>'13', 'pattern'=>'\d+-?\d{4}', 'placeholder'=>'55519999-8888')); ?>
		<?php echo $form->error($model,'telefone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'RG'); ?>
		<?php echo $form->textField($model,'RG', array('size'=>65, 'pattern'=>"\d+", 'placeholder'=>"Ex: xxxxxx...")); ?>
		<?php echo $form->error($model,'RG'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'pagina_pessoal'); ?>
		<?php echo $form->textField($model,'pagina_pessoal', array('type'=>'url', 'size'=>'65', 'placeholder'=>"http://www.minha-pagina.com")); ?>
		<?php echo $form->error($model,'pagina_pessoal'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'orgao_departamento'); ?>
		<?php echo $form->textField($model,'orgao_departamento', array('size'=>65, 'placeholder'=>'Ex: Escola de Administração, Instituto de Informática, etc.')); ?>
		<?php echo $form->error($model,'orgao_departamento'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'endereco_profissional'); ?>
		<?php echo $form->textField($model,'endereco_profissional', array('size'=>65, 'placeholder'=>'Ex: Rua das Alamedas, 305/35')); ?>
		<?php echo $form->error($model,'endereco_profissional'); ?>
	</div>


</div> <!-- fim da coluna da direita -->

<div class="center">
	<div class="row">
		<h4><?php echo $form->labelEx($model,'descricao'); ?></h4>
		<?php echo $form->textArea($model, 'descricao');?>
		<?php echo $form->error($model,'descricao'); ?>
	</div>

	<br>
	
	<?php 
	$categoriasComFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'categoriaPai', 'order'=>'t.ordem', 'condition'=>'t.cod_categoria_pai is not null')), 'cod_categoria', 'nome', 'categoriaPai.nome');
	$categoriasSemFilhos = CHtml::listData(Categoria::model()->findAll(array('with'=>'secundarias',  'condition'=>'secundarias is null AND t.cod_categoria_pai is null')), 'cod_categoria', 'nome', 'secundarias.nome');
	?>
	<div class="row">
		<?php echo $form->labelEx($model,'categorias'); ?>
		<?php  echo $form->listBox($model,'categorias', array_merge($categoriasComFilhos, $categoriasSemFilhos), array("multiple"=>"multiple", "size"=>Categoria::model()->count())  ); ?>
		<?php echo $form->error($model,'categorias'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'grupos'); ?>
		<?php  echo $form->listBox($model,'grupos', CHtml::listData(GrupoTrabalho::model()->findAll(array('order'=>'nome')), 'cod_gt', 'nome'), array("multiple"=>"multiple", "size"=>GrupoTrabalho::model()->count())  ); ?>
		<?php echo $form->error($model,'grupos'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'imageFile'); ?>
		<?php echo $form->fileField($model,'imageFile'); ?>
		<br><span class="hint">Arquivos com aspecto 1:1 e menores que 400kbytes</span>
		<?php echo $form->error($model,'imageFile'); ?>
	</div>
	
</div>


<br>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array('class'=>'button')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->