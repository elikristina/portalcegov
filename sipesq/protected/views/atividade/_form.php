<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/socket.io.min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jquery.tokeninput.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/tokenhelper.js');?>
<?php Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl .'/css/token/token-input-facebook.css');?>
<?php 
//Carrega editor de textos
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/tiny_mce/tiny_mce.js');
Yii::app()->clientScript->registerScript('text-areas',"
		tinyMCE.init({
								mode : 'textareas',
								theme : 'simple',
								width: '500',
        						height: '150',
        						relative_urls : false,
        						language: 'pt'
							});
	");

Yii::app()->clientScript->registerCss('label',"
		label {	font-weight: bold; }
");
?>

<?php Yii::app()->clientScript->registerScript('drop_categoria_pai',"

	$('#drop_categoria_pai').change(
	function(){
	 pai = $('#drop_categoria_pai').val();
	 $.get('/sipesq/index.php/atividadeCategoria/listChildren/'	,
					
				{id: pai},function (data){
						$('#Atividade_cod_categoria').html(data);
					},
					\"html\"); 
	}
	);
");
?>
<?php if($model->isNewRecord):?>
	<?php Yii::app()->clientScript->registerScript('tokenInput',"
	
		var th = new TokenHelper();
	
		th.init({	
			onAdd: function(item){
			 var s = document.createElement('input');
			 $(s).attr('type', 'hidden')
			 .attr('id', 'input_' + item.id)
			 .val(item.id)
			 .attr('name', 'Atividade[pessoas][]');
			 
			 $('#atividade-form').append(s);
			 console.log(item.name + 'adicionado');
			},
			
			onDelete: function(item){
				$('#input_' + item.id).remove();
				console.log(item.name + 'removido');
			}
			
		});
	
	");
	?>
<?php else:?>
	<?php Yii::app()->clientScript->registerScript('tokenInput',"
	
		var th = new TokenHelper();
		var atvId = " .$model->cod_atividade .";
		var url = \"/sipesq/index.php/atividade/tokenPessoa/\" + atvId;
	
		
		$.getJSON(url, function(data){
				
			th.init({	
				prePopulate: eval(data),
				
				onAdd: function(item){
				 var s = document.createElement('input');
				 $(s).attr('type', 'hidden')
				 .attr('id', 'input_' + item.id)
				 .val(item.id)
				 .attr('name', 'Atividade[pessoas][]');
				 
				 $('#atividade-form').append(s);
				 console.log(item.name + 'adicionado');
				},
				
				onDelete: function(item){
					$('#input_' + item.id).remove();
					console.log(item.name + 'removido');
				}
				
			});
			
		});
		
	
	");
	?>
<?php endif;?>

<?php $server = 'http://' .Yii::app()->request->serverName .':8000'?>
<?php Yii::app()->clientScript->registerScript('multiple-select',"

	$(\"select[multiple]\").bind(\"mousedown\", function(e) {
    	$(this).data(\"remove\", !$(e.target).is(\":selected\"));
    	$(this).data(\"selected\", $(this).find(\":selected\"));
 	 }).bind(\"mouseup\", function(e){
    	$(this).data(\"selected\").attr(\"selected\", \"selected\");
    	e.target.selected = $(this).data(\"remove\");
  		});
");

?>



<?php Yii::app()->clientScript->registerScript('submit-broadcast',"
	$('#submitButton').click(
		function(){
			socket.emit('alert', {data: 'Atividade Modificada/Criada'});
		 	socket.emit('activityUpdated');
		 	$('#atividade-form').submit();
	  	
	});
");


?>


<?php 
	if($model->isNewRecord){
	Yii::app()->clientScript->registerScript('get_description',"

		$('#Atividade_cod_categoria').change(
		function(){
		 id = $('#Atividade_cod_categoria').val();
		 $.get('/sipesq/index.php/atividadeCategoria/getDescription/'	,
						
					{id: id},function (data){
							$('#Atividade_descricao').html(data);
						},
						\"html\"); 
		}
		);
	");
	}
	
?>
<script>
var server = "<?php echo $server ?>";
var socket = io && io.connect(server);
</script>


<div class="form">


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'atividade-form',
	'enableAjaxValidation'=>true,
	'errorMessageCssClass'=>'alert'
)); ?>

	<?php CHtml::$errorCss = 'control-group warning';?>

	<div class="alert alert-info">
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  Campos com <strong>*</strong> são obrigatórios.
	</div>
	
	<?php
		 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
		 $footer = "</div>";
		echo $form->errorSummary($model, $header, $footer); 
	?>
	
		<div class="input">
		<?php echo $form->labelEx($model,'nome_atividade'); ?>
		<?php echo $form->textField($model, 'nome_atividade', array('class'=>'input-xxlarge'))?>
		<?php echo $form->error($model,'nome_atividade'); ?>
	</div>
	<div class="input">
	<label><b>Categoria Primária</b></label>
	<?php $cPai = ''?>
	<?php if(is_object($model->categoria) && is_object($model->categoria->categoriaPai)) $cPai = $model->categoria->categoriaPai->cod_categoria?>
	<?php  echo CHtml::dropDownList('drop_categoria_pai',$cPai, CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')), 'cod_categoria', 'nome'), array('class'=>'input-xxlarge')); ?><br>
	<label><b>Categoria Secundária</b></label>
	<?php  echo $form->dropDownList($model,'cod_categoria', CHtml::listData(AtividadeCategoria::model()->findAll(array('condition'=>'cod_categoria = ' .$model->cod_categoria)),'cod_categoria','nome'), array('class'=>'input-xxlarge')); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'estagio');?>
		<?php  //echo $form->dropDownList($model,'estagio', array('0'=>'A Fazer', '1'=>'Finalizada')); ?>
		<?php  echo $form->checkBox($model,'estagio');?>
		<?php echo $form->error($model,'estagio'); ?>
	</div>

	<div class="input">
		<?php echo $form->labelEx($model,'cod_pessoa');?>		
		<?php  echo $form->dropDownList($model,'cod_pessoa', CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array('class'=>'input-xxlarge')); ?>
		<?php echo $form->error($model,'cod_pessoa'); ?>
	</div>
	

	<div class="input">
		<?php echo $form->labelEx($model,'descricao'); ?>
		<?php echo $form->textArea($model, 'descricao', array('rows'=>15))?>
		<br><?php echo $form->error($model,'descricao'); ?>
	</div>


	
	<div class="input ">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php echo CHtml::tag('input', array('name'=>'Atividade[data_inicio]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_inicio))?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>
	
	<div class="input ">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php echo CHtml::tag('input', array('name'=>'Atividade[data_fim]', 'type'=>'date', 'value'=> $model->isNewRecord ? date('Y-m-d') : $model->data_fim))?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>

	<?php /*
	
		<div class="input">
		<?php echo $form->labelEx($model,'data_inicio'); ?>
		<?php //echo $form->textField($model,'data_inicio'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Atividade[data_inicio]',
				'value'=>isset($model->data_inicio) ? $model->data_inicio : date('d/m/Y'),
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'dd/mm/yy'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_inicio'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'data_fim'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'Atividade[data_fim]',
				'value'=>isset($model->data_fim) ? $model->data_fim : date('Y-m-d'),
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop','dateFormat'=>'yy-mm-dd'),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
		<?php echo $form->error($model,'data_fim'); ?>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'turnos_trabalho'); ?>
		<?php echo $form->textField($model,'turnos_trabalho'); ?>
		<?php echo $form->error($model,'turnos_trabalho'); ?>
	</div> */?>

	<div class="input">
		<?php echo $form->labelEx($model,'projetos'); ?>
		<?php if(Sipesq::getPermition('projeto.informacoes')):?>
				<?php echo $form->listBox($model,'projetos', CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome', 'categoria.nome'), array("multiple"=>"multiple", "size"=>"15", "class"=>"input-xxlarge",)  ); ?>
		<?php else:?>
			<?php echo $form->listBox($model,'projetos', CHtml::listData(Projeto::findAllOfUser(), 'cod_projeto', 'nome', 'categoria.nome'), array("multiple"=>"multiple", "size"=>"15", "class"=>"input-xxlarge",)  ); ?>
		<?php endif;?>
		<?php echo $form->error($model,'projetos'); ?>
	<div class="hint">Segure a tecla <b>CTRL</b> para selecionar mais de um projeto.</div><br>
	</div>
	
	<div class="input">
		<?php echo $form->labelEx($model,'pessoas'); ?>
		<?php //echo $form->listBox($model,'pessoas', CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array("multiple"=>"multiple", "size"=>"10",)  ); ?>
		<?php echo CHtml::textField('Token','', array('id'=>'token-input'))?>
		<?php echo $form->error($model,'pessoas'); ?>
	</div>
	
	<?php 
	/*
	<div class="input">	
		<?php echo $form->labelEx($model,'bolsas'); ?>
		<?php echo $form->listBox($model,'bolsas', CHtml::listData(PessoaFinanceiro::model()->with('pessoa')->findAll(array('order'=>'pessoa.nome')), 'cod_financeiro', 'resumo', 'pessoa.nome'), array("multiple"=>"multiple", "size"=>"10",)  ); ?>
		<div class="hint">Segure a tecla <b>CTRL</b> para selecionar mais de uma bolsa.</div><br>
	</div>
	
	*/?>

	<div class="input buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Adicionar' : 'Salvar', array(
			'id'=>'submitButton',
			'class'=>'btn btn-small btn-primary'
		)) ?> 					
	</div>
	
	<?php if(!$model->isNewRecord):?>
		<?php foreach($model->pessoas as $p):?>
			<?php echo CHtml::hiddenField('Atividade[pessoas][]',$p->cod_pessoa, array('id'=>'input_' .$p->cod_pessoa))?>
		<?php endforeach;?>
	<?php endif;?>

<?php $this->endWidget(); ?>

</div><!-- form -->