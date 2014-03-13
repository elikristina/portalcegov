<?php $url = $this->createUrl('/atividade/createPasso', array('id'=>$model->cod_atividade))?>
<?php Yii::app()->clientScript->registerScript('addPasso', "
	$('#addPasso').click(
	function(){
		if(($('#AtividadePasso_cod_pessoa').val()) && ($('#AtividadePasso_descricao').val())){
		$.post('{$url}', 
		$('#passo-form').serialize()
		,
   		function(data) {
     		$('#passos-holder').append(data + '<br>');
     		//$('.ok-button').click(okButtonListener);
	   	});
	   	}else{
	   		alert('Você deve preencher a descrição e responsável');
	   	}
	}
	
	);
	
");?>

<?php $url = $this->createUrl('/atividade/passoConcluido')?>
<?php Yii::app()->clientScript->registerScript('okPasso', "
	function okButtonListener(){
		if(this.checked){
			
			$(this).parent('div').hide('slow');
			
			$.post('{$url}' + '/' + $(this).attr('id') , 
				{finalizado: true, 
				},
		
   		function(data) {
     		$('#passos-holder').append(data);
	   	});
		}else{
			
			$(this).parent('div').hide('slow');
		
			$.post('{$url}' + '/' + $(this).attr('id') ,
				{finalizado: false},
		
   		function(data) {
     		$('#passos-holder').append(data);
	   	});
	}
		$('.ok-button').unbind('click');
		$('.ok-button').click(okButtonListener);
	}
	
	$('.ok-button').click(okButtonListener);
");?>

	<h4>Passos</h4>
	<?php foreach($model->passos as $p):?>
			<?php $this->renderPartial('/atividade/passo/_view', array('model'=>$p))?>
	<?php endforeach;?>
	<br>

