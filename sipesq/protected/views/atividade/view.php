<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/socket.io.min.js');?>
<?php $server = 'http://' .Yii::app()->request->serverName .':8000'?>

<?php
$this->breadcrumbs=array(
	'Atividades'=>array('index'),
	$model->nome_atividade,
);

$this->menu=array(
	array('label'=>'Listar Atividades', 'url'=>array('index')),
	array('label'=>'Adicionar Atividade', 'url'=>array('create')),
	array('label'=>'Editar Atividade', 'url'=>array('update', 'id'=>$model->cod_atividade)),
	array('label'=>'Deletar Atividade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_atividade),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Gerenciar Atividades', 'url'=>array('admin')),
);
?>

<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jquery.tokeninput.js');?>
<?php Yii::app()->clientScript->registerCSSFile(Yii::app()->request->baseUrl .'/css/token/token-input-facebook.css');?>
<?php Yii::app()->clientScript->registerScript('tokenPasso',"

	
	var url = \"/sipesq/index.php/pessoa/json/\";

	
			
		$('#AtividadePasso_cod_pessoa').tokenInput(url, {	
			
			onAdd: function(item){
				$('#AtividadePasso_cod_pessoa').val(item.id);
			 	console.log(item.name + 'adicionado');
			},
			
			onDelete: function(item){
				$('#AtividadePasso_cod_pessoa').val(null);
				console.log(item.name + 'removido');
			},
			
			theme: 'facebook',
			searchingText: 'Buscando',
			hintText: 'Digite um nome',
			tokenLimit: 1
			
		});
		
	

");
?>

<script>
	var server = "<?php echo $server ?>";
	var socket = io && io.connect(server);

	var Passo = {
			updatePasso: function(e){
			
						var data = $('#atividade-passo-form').serializeArray();
						
						var validate = true; 
						for(d in data){
						 if(data[d].value == null || data[d].value == '')
						  validate = false;
						}
						
					if(validate){
					
						//AtividadePasso_descricao
						$.post($('#atividade-passo-form').attr('action'), data, function(data){
						
							$($('#btn-modal-save').attr('data-replace')).html(data);
							$($('#btn-modal-save').attr('data-replace') + ' .icon').tooltip();
							$($('#btn-modal-save').attr('data-replace') + ' .btnDeleteCampo').click(Passo.deletePasso);
							$($('#btn-modal-save').attr('data-replace') + ' .btnEditAtv').click(Passo.editButton);
							
						});
						$('#modalAtvEdit').modal('hide');
							
						socket.emit('activityUpdated');
						
					}else{
					  alert('Preencha todos os campos');
					}
				
				}
			
			, deletePasso: function(){
				if(confirm('Deseja deletar este campo?')){
				
					$.post($(this).attr('data-href'), {id: $(this).attr('data-cod-passo')}, function(data){
						console.log('Passo ' + data + ' foi excluido');
					}).error(function(){
						alert('Erro! Não foi possível deletar este campo');
					});
					
					$(this).parent().parent().remove();
					socket.emit('activityUpdated');
				}
			}
		 ,editButton: function(){
				$('#form-atv-body').load($(this).attr('href'));
				$('#btn-modal-save').attr('data-replace',$(this).attr('data-replace'));
							
			}
		};
</script>

<?php $url = $this->createUrl('/atividade/createPasso', array('id'=>$model->cod_atividade))?>
<?php Yii::app()->clientScript->registerScript('addPasso', "
	$('#addPasso').click(
	function(){
		if(($('#AtividadePasso_cod_pessoa').val()) && ($('#AtividadePasso_descricao').val())){
		$.post('{$url}', 
		$('#passo-form').serialize()
		,
   		function(data) {
   			$('#AtividadePasso_descricao').val('');
     		$('#panel-passos-abertos').append(data);
     		$('.icon').tooltip();
     		
     		$('.btnDeleteCampo').unbind('click');
			$('.btnDeleteCampo').click(Passo.deletePasso);
			
			$('.btnEditAtv').unbind('click');
			$('.btnEditAtv').click(Passo.editButton);

			$('.ok-button').unbind('click');
			$('.ok-button').click(okButtonListener);
			
		 	socket.emit('activityUpdated');
	   	});
	   	}else{
	   		alert('Você deve preencher a descrição e responsável');
	   	}
	}
	
	);
	
	$('.icon').tooltip();
	$('.btnEditAtv').click(Passo.editButton);
	$('#btn-modal-save').click(Passo.updatePasso);
	$('.btnDeleteCampo').click(Passo.deletePasso);

");?>

<?php $url = $this->createUrl('/atividade/passoConcluido')?>
<?php Yii::app()->clientScript->registerScript('okPasso', "
	function okButtonListener(){

		var passo_id = '#passo-' + $(this).attr('id');
		$(passo_id).remove();		

		if(this.checked){
			
			
			$.post('{$url}' + '/' + $(this).attr('id') , 
				{
					finalizado: true, 
				},
		
   		function(data) {
     		$('#panel-passos-finalizados').append(data);
     		$('.ok-button').unbind('click');
			$('.ok-button').click(okButtonListener);
	   	});
		}else{

			$.post('{$url}' + '/' + $(this).attr('id') ,
				{finalizado: false},
		
	   		function(data) {
	     		$('#panel-passos-abertos').append(data);
	     		$('.ok-button').unbind('click');
				$('.ok-button').click(okButtonListener);

		   	});
		}

		
	}
	
	$('.ok-button').click(okButtonListener);
");?>

<div class="view <?php echo $model->class;?>">
<h4 align="center"><b><?php echo $model->nome_atividade; ?></b></h4>


<div class="row-fluid">
<div class="span4">

	<b><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>:</b>
	<span class="label <?php echo $model->label ?>"><?php echo CHtml::encode($model->statusName); ?></span>
	<br />

	<b>Categoria:</b>
	<?php if(is_object($model->categoria)):?>
	<?php if($model->categoria->categoriaPai->cod_categoria != $model->categoria->cod_categoria ):?>
		<?php echo CHtml::encode($model->categoria->categoriaPai->nome);?> <b>&gt;</b> 
	<?php endif;?>
	 <?php echo CHtml::encode($model->categoria->nome);?>
	<?php endif;?>
		
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('responsavel')); ?>:</b>
	<?php echo CHtml::encode($model->responsavel->nome); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('data_inicio')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_inicio)); ?>
	<br />

	<b><?php echo CHtml::encode($model->getAttributeLabel('data_fim')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_fim)); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('data_criacao')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_criacao)); ?>
	<br />
	
	<b><?php echo CHtml::encode($model->getAttributeLabel('data_edicao')); ?>:</b>
	<?php echo CHtml::encode(Sipesq::date($model->data_edicao)); ?>
	<br />
</div>
<div class="span7">	
	<?php echo $model->descricao; ?>
</div>
<?php /*
<div class="span1">	
	<button id="atv-edit" class="btn btn-primary btn-small" data-atv-id="<?php echo $model->cod_atividade?>">Editar</button>
	<?php $this->renderPartial('_modal_form', array('model'=>$model)); ?>
</div> */?>

</div><!-- /header -->

<hr>
<div class="row-fluid">
<div class="span6">
	<label><b>Participantes</b></label>
	<?php foreach($model->pessoas as $pessoa):?>
		<?php echo CHtml::link(CHtml::encode($pessoa->nome), array('/pessoa/view', 'id'=>$pessoa->cod_pessoa)); ?>
		<br />
	<?php endforeach;?>
</div>

<div class="span6">
	<label><b>Projetos</b></label>
	<?php foreach($model->projetos as $projeto):?>
		<?php echo CHtml::link(CHtml::encode($projeto->nome)
			, array('/projeto/atividades', 'id'=>$projeto->cod_projeto)
		); ?>
		<br />
	<?php endforeach;?>
</div>
</div>
</div>

<?php $userId = Yii::app()->user->getId(); ?>
<?php if($model->isResponsible($userId) || $model->isParticipating($userId) || $model->hasStep($userId) || Sipesq::getPermition('atividade.informacoes' >= 2)): ?>
	<div class="view form">
	<h4>Adicionar Passo</h4>
	<?php $passo = new AtividadePasso();?>
	<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'passo-form',
		'enableAjaxValidation'=>true,
		'errorMessageCssClass'=>'alert alert-danger',
		'enableClientValidation'=>true,
		'htmlOptions'=>array('class'=>'form-inline'),
	)); ?>

		<?php CHtml::$errorCss = 'control-group warning';?>	

		<?php
			 $header = "<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
			 $footer = "</div>";
			echo $form->errorSummary($passo, $header, $footer); 
		?>

		<div class="row-fluid">
			<div class="span6">
				<div class="input">
			<?php echo $form->labelEx($passo,'data_prazo'); ?>
			<?php echo CHtml::tag('input', array('name'=>'AtividadePasso[data_prazo]', 'type'=>'date', 'value'=> date('Y-m-d')))?>
			<?php echo $form->error($passo,'data_prazo'); ?>
		</div>
		
		<div class="input">
			<?php echo $form->labelEx($passo,'cod_pessoa'); ?>
			<?php $listDataPessoas = CHtml::listData(Pessoa::model()->with('categoria')->findAll(array('order'=>'equipe_atual DESC, t.nome')), 'cod_pessoa', 'nome', 'categoria.nome');?>
			<?php  //echo $form->dropDownList($passo,'cod_pessoa', $listDataPessoas, array('prompt'=>"Selecione uma Pessoa")); ?>
			<?php echo $form->textField($passo, 'cod_pessoa')?>
			<?php echo $form->error($passo,'cod_pessoa'); ?>
		</div>
			</div>
			<div class="span6">
				<div class="input">
					<?php echo $form->labelEx($passo,'descricao'); ?>
					<?php echo $form->textArea($passo,'descricao', array('class'=>'input-xxlarge', 'placeholder'=>"Descrição")); ?>
					<?php echo $form->error($passo,'descricao'); ?>
				</div>
			</div>
		</div>
		
		
		
		
		
			
		

		<div class="input buttons">
	        <?php echo CHtml::link('Adicionar',null, array("id"=>'addPasso', 'class'=>'btn btn-small btn-small'))?>
		</div>

	<?php $this->endWidget(); ?>    
	</div>    
<?php endif; ?>	

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/panel.css');?>
<?php Yii::app()->clientScript->registerCss("passos","
	.panel-passos{
		max-height: 600px;
		overflow: auto;
	}
");?>
<div class="row-fluid">
	<div class="span6">
		<h4>Passos em Aberto</h4>
		<div class="panel-passos" id="panel-passos-abertos">
			<?php foreach($model->passos_abertos as $p):?>
				<?php $this->renderPartial('/atividade/passo/_view', array('model'=>$p))?>
			<?php endforeach;?>
		</div>
	</div>
	<div class="span6">
		<h4>Passos Finalizados</h4>
		<div class="panel-passos" id="panel-passos-finalizados">
			<?php foreach($model->passos_finalizados as $p):?>
				<?php $this->renderPartial('/atividade/passo/_view', array('model'=>$p))?>
			<?php endforeach;?>
		</div>
	</div>
</div>    

<div class="modal hide" id="modalAtvEdit">
	<div class="modal-header">
		<a class="close" data-dismiss="modal"><i class="icon icon-remove"></i></a>
		<h3>Editar Passo</h3>
	</div>
	<div class=".modal-body" id="form-atv-body"  style="padding: 20px;">
	
	</div>
	<div class="modal-footer">
		<button href="#" class="btn" data-dismiss="modal" onclick="$('#form-atv-body').html('');">Fechar</button>
		<a id="btn-modal-save" class="btn btn-primary" style="text-decoration: none">Salvar</a>
	</div>
</div>