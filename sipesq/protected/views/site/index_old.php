<script>
	var options = {};
	var server = "http://" + "<?php echo Yii::app()->request->serverName ?>:8000"

	function filtraPessoa()
	{	
			
    	var pessoa = $('#dropDownPessoa').val();
    	if(pessoa){        	
        	$('.atv-list').html('Carregando...');
        	options.pessoa = pessoa;
        	fillPage(options);
    	}
	}
</script>

<?php $this->pageTitle=Yii::app()->name; ?>

<?php 
//Registra os scripts para o scroll
$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.jscrollpane.min.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.mousewheel.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/mwheelIntent.js");
Yii::app()->clientScript->registerCssFile($baseUrl ."/jScrollPane/jquery.jscrollpane.css");
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/socket.io.min.js');

?>

<?php if(Yii::app()->user->isGuest):?>
	<div class="view">
	
	<?php 
		$model=new LoginForm;
		$this->renderPartial("_login", array('model'=>$model)); 
	?>
	</div>
<?php endif;?>

<div class="span-22">
<?php $this->renderPartial('_calendar')?>
</div>

<?php if(!Yii::app()->user->isGuest):?>

	<?php if(Sipesq::isAdmin()):?>
		<b>Pessoa</b><br>
		<?php echo CHtml::dropDownList('dropDownPessoa','',CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Selecione uma Pessoa",'onchange'=>'filtraPessoa();',));?><br>
	<?php endif;?>
	
	<?php $user = Pessoa::findByUserName(Yii::app()->user->name); ?>


	<div id="update-form"></div>
	<div class="span-24">
		<div class="kanban-wrapper">
			<div class="span-7 kanban-box" id="atv-todo">
				<div class="kanban-header">A fazer</div>
				<div class="kanban atv-list" id="atv-list-todo">		
				</div>
			</div>
			
			<div class="span-7 kanban-box" id="atv-today">
				<div class="kanban-header">Hoje</div>
				<div class="kanban atv-list" id="atv-list-today">
				</div>
			</div>
			 
			<div class="span-7 kanban-box last" id="atv-done">
				<div class="kanban-header">Concluídas</div>
				<div class="kanban atv-list" id="atv-list-done">
				</div>
			</div>
		</div>
		
	</div>
	<hr>
	<div id="pendencias">
		<?php  $this->renderPartial("_pendencias", array('user'=>$user)); ?>
	</div>


<div id="agenda-bolsistass">
	<h4><b>Horário dos Bolsistas</b></h4>
	<?php  $this->renderPartial("/agenda/_agenda"); ?>
	<!-- Ferias -->
	<?php $ferias = Ferias::findAllInVacation();?>
	<?php if(count($ferias) > 0):?>
	<b>Pessoas em férias:</b>
	<?php for($i=0; $i < count($ferias); $i++):?>
		<?php echo $ferias[$i]->pessoa->nome_curto; echo ($i === count($ferias) -1) ? '.' : ', ';?>
	<?php endfor;?>
	<?php endif;?>
</div>
<br>
<hr>
<?php endif;?>

<!-- 
<div class="agenda-cepik">
<h4><b>Agenda CEGOV</b></h4>
	<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=455&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=gerenciacepik%40gmail.com&ctz=America/Sao_Paulo" style="border: 0" width="100%" height="300" frameborder="0" scrolling="no"></iframe>
</div>
 -->

<?php  Yii::app()->clientScript->registerLinkTag('stylesheet/less', null,Yii::app()->request->baseUrl .'/css/kanban.less');?>
<?php //Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/kanban.min.css');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/jqueryui/jquery-ui.css');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/jqueryui.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/kanban.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .'/js/async.min.js');?>

<?php if(!Yii::app()->user->isGuest): ?>
	<script>

		  	
		   	var socket = io && io.connect(server)	     
	     	,username = "<?php echo Yii::app()->user->name; ?>"

		$('.atv-list').css({
			"min-height": '50px',
			'max-height': '300px',
			'overflow': 'auto'
							

		});
		
				
	    	var pessoa = false;
	    	<?php if($user != null): ?>
	    		pessoa = <?php echo $user->cod_pessoa; ?>;
	    	<?php endif; ?>

	    	 socket.on('connection', function(){
		        	//Envia o username
		            socket.emit('username', username);
		     });

		     socket.on('newactivity', function(activity){

		      fillPage(options);
		      
		      console.log('Chegou Atividade');
		    });

	    	if(pessoa){        	
	        	$('.atv-list').html('Carregando...');
	        	options.pessoa = pessoa;	    
		    	//Preenche as atividades
				fillPage(options);	
	    	}


	</script>
<?php endif; ?>