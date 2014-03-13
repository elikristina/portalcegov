<script>
var options = {}
var server = "http://" + "<?php echo Yii::app()->request->serverName ?>:8000"

function filtraAtividade (){
    	
    	$('.atv-list').html('Carregando...');

		var projeto = $('#dropDownProjeto').val();

		if(projeto){
    	 options.projeto =  projeto; 
    	}
    	
    	var pessoa = $('#dropDownPessoa').val();
    	if(pessoa){
        	options.pessoa =  pessoa;
    	}
    	

    	var categoria = $('#dropDownCategoria').val();
    	if(categoria){
        	options.categoria = categoria;
    	}

    	fillPage(options);
    	console.log("filtrou");
    	
	}
</script>
<?php
$this->breadcrumbs=array(
	'Atividades',
);

$this->menu=array(
	array('label'=>'Adicionar Atividade', 'url'=>array('create')),
	array('label'=>'Gerenciar Atividades', 'url'=>array('admin')),
);
?>

<?php Yii::app()->clientScript->registerLinkTag('stylesheet/less', null,Yii::app()->request->baseUrl .'/css/kanban.less');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/kanban.min.css');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/jqueryui/jquery-ui.css');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jqueryui.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/kanban.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/async.min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/socket.io.min.js');?>

<div class="row-fluid">
<div class="span12">
	<h1>Atividades</h1>
	<b>Projeto</b><br>
	<?php echo CHtml::dropDownList('dropDownProjeto',$projeto,CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')), 'cod_projeto', 'nome'), array('prompt'=>"Selecione um Projeto",'onchange'=>'filtraAtividade();' ,'class'=>"input-xxlarge"));?><br>
	<br>
</div>
	<div class="span12">
		<b>Pessoa</b><br>
		<?php echo CHtml::dropDownList('dropDownPessoa',$pessoa,CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Selecione uma Pessoa",'onchange'=>'filtraAtividade();' ,'class'=>"input-xxlarge"));?><br>
		<b>Categoria</b><br>
		<?php echo CHtml::dropDownList('dropDownCategoria',$categoria, CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome', 'condition'=>'cod_categoria_pai = cod_categoria')), 'cod_categoria', 'nome'), array('prompt'=>'Selecione uma Categoria', 'onchange'=>'filtraAtividade();' ,'class'=>"input-xxlarge")); ?><br>
		<?php //echo CHtml::button('Filtrar',array('onclick'=>'filtraAtividade()')); ?> 
		<?php echo CHtml::submitButton('Limpar', array('submit'=>$this->createUrl('index'), 'class'=>'btn btn-small ')); ?>
	</div>
</div>


<div class="row-fluid">
	<div class="span12">
		<?php $this->renderPartial('/site/_calendar')?>
	</div>
</div>

<div id="update-form"></div>
<div class="row-fluid">
		<div class="kanban-wrapper">
			<div class="span4 kanban-box" id="atv-todo">
				<div class="kanban-header">A fazer</div>
				<div class="kanban atv-list" id="atv-list-todo">		
				</div>
			</div>
			
			<div class="span3 kanban-box" id="atv-today">
				<div class="kanban-header">Hoje</div>
				<div class="kanban atv-list" id="atv-list-today">
				</div>
			</div>
			 
			<div class="span4 kanban-box last" id="atv-done">
				<div class="kanban-header">Concluídas</div>
				<div class="kanban atv-list" id="atv-list-done">
				</div>
			</div>
		</div>
		
	</div>


<script>	

	(function(){
	    
	     
	     var socket = io && io.connect(server)
	     ,username = "<?php echo Yii::app()->user->name; ?>"     

	     //envia o username
	     socket.emit('username', username)

	    //Preenche as atividades
		fillPage(options)

	
	      socket.on('newactivity', function(activity){

	      fillPage(options)
	      console.log('Chegou Atividade')
	    })

	     socket.on('userconnect', function(user){

	     })

	}())
</script>
