<?php
$this->breadcrumbs=array(
	'Agenda',
);?>
<?php Yii::app()->clientScript->registerScript('renderAgenda',"
function renderizaAgenda(){
$.get('/portalcegov/sipesq/index.php/agenda/render/',
 					function(data) {
 					$('#agenda').html(data);
					});
}

$(document).ready(function(){renderizaAgenda()});
"
);?>
<?php Yii::app()->clientScript->registerScript('chk_dia',"

	$('#drop-pessoa').change(
	
	function(){
		
		//Limpa os marcados	
		$('.dia-semana').attr('checked', false);
		
		//Marca os horarios
		var id = $(this).val();
		$.get('/portalcegov/sipesq/index.php/agenda/ajaxget/', { id: id },
 					function(data) {
 					var horarios = eval(data);
 					
 					for(i=0; i < horarios.length; i++){
 						$('#' + horarios[i].local + '-' + horarios[i].dia_semana + '-' + horarios[i].turno).attr('checked', true);
 					}
 					
 			}, 
 			\"json\");
	});


	$('.manha').change(
	function(){
		if($(this).is(':checked')){
		
			//Adiciona um horario
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).attr('name');
			var local = $(this).val();
			
			$.get('/portalcegov/sipesq/index.php/agenda/ajaxcreate/', { id: pessoa, turno: 'manha', dia_semana: dia, local: local },
 					function() {
 					$('.verde').html('<b>Horário Adicionado com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 					
 			}, 
 			'html');
			
		
			
		}else{
			//Remove um horario
			
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).attr('name');
			var local = $(this).val();
			
			$.get('/portalcegov/sipesq/index.php/agenda/ajaxdelete/', { id: pessoa, turno: 'manha', dia_semana: dia, local: local },
 					function() {
 					$('.verde').html('<b>Horário Removido com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 					
 			}, 
 			'html');
			
		}
		 
		 return false;
	});
	
	
	$('.tarde').change(
	function(){
		if($(this).is(':checked')){
		
			//Adiciona um horario
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).attr('name');
			var local = $(this).val();
			
			$.get('/portalcegov/sipesq/index.php/agenda/ajaxcreate/', { id: pessoa, turno: 'tarde', dia_semana: dia, local: local },
 					function() {
 					$('.verde').html('<b>Horário Adicionado com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 			}, 
 			'html');
			
		
			
		}else{
			//Remove um horario
			
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).attr('name');
			var local = $(this).val();
			
			$.get('/portalcegov/sipesq/index.php/agenda/ajaxdelete/', { id: pessoa, turno: 'tarde', dia_semana: dia, local: local },
 					function() {
 					$('.verde').html('<b>Horário Removido com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 			}, 
 			'html');
			
		}
		 
		 return false;
	});
");
?>


<?php if(!Yii::app()->user->isGuest):?>
	<?php echo CHtml::dropDownList('drop_pessoa','cod_pessoa',CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array('id'=>'drop-pessoa', 'prompt'=>"Selecione uma pessoa") ); ?>
	<form>
		<div class="row-fluid">
			<div class="span2">
				<h4>Manhã</h4>
			</div>
			<div class="span2">
				<h4>Segunda</h4>
				<label class="horario"><input class="dia-semana manha" id="105-segunda-manha" type="checkbox" name="segunda" value="105" />105</label>
				<label class="horario"><input class="dia-semana manha" id="122-segunda-manha" type="checkbox" name="segunda" value="122" />122</label>
				<label class="horario"><input class="dia-semana manha" id="128-segunda-manha" type="checkbox" name="segunda" value="128" />128</label>
				<label class="horario"><input class="dia-semana manha" id="FCE-segunda-manha" type="checkbox" name="segunda" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana manha" id="Remoto-segunda-manha" type="checkbox" name="segunda" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Terça</h4>
				<label class="horario"><input class="dia-semana manha" id="105-terca-manha" type="checkbox" name="terca" value="105" />105</label>
				<label class="horario"><input class="dia-semana manha" id="122-terca-manha" type="checkbox" name="terca" value="122" />122</label>
				<label class="horario"><input class="dia-semana manha" id="128-terca-manha" type="checkbox" name="terca" value="128" />128</label>
				<label class="horario"><input class="dia-semana manha" id="FCE-terca-manha" type="checkbox" name="terca" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana manha" id="Remoto-terca-manha" type="checkbox" name="terca" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Quarta</h4>
				<label class="horario"><input class="dia-semana manha" id="105-quarta-manha" type="checkbox" name="quarta" value="105" />105</label>
				<label class="horario"><input class="dia-semana manha" id="122-quarta-manha" type="checkbox" name="quarta" value="122" />122</label>
				<label class="horario"><input class="dia-semana manha" id="128-quarta-manha" type="checkbox" name="quarta" value="128" />128</label>
				<label class="horario"><input class="dia-semana manha" id="FCE-quarta-manha" type="checkbox" name="quarta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana manha" id="Remoto-quarta-manha" type="checkbox" name="quarta" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Quinta</h4>
				<label class="horario"><input class="dia-semana manha" id="105-quinta-manha" type="checkbox" name="quinta" value="105" />105</label>
				<label class="horario"><input class="dia-semana manha" id="122-quinta-manha" type="checkbox" name="quinta" value="122" />122</label>
				<label class="horario"><input class="dia-semana manha" id="128-quinta-manha" type="checkbox" name="quinta" value="128" />128</label>
				<label class="horario"><input class="dia-semana manha" id="FCE-quinta-manha" type="checkbox" name="quinta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana manha" id="Remoto-quinta-manha" type="checkbox" name="quinta" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Sexta</h4>
				<label class="horario"><input class="dia-semana manha" id="105-sexta-manha" type="checkbox" name="sexta" value="105" />105</label>
				<label class="horario"><input class="dia-semana manha" id="122-sexta-manha" type="checkbox" name="sexta" value="122" />122</label>
				<label class="horario"><input class="dia-semana manha" id="128-sexta-manha" type="checkbox" name="sexta" value="128" />128</label>
				<label class="horario"><input class="dia-semana manha" id="FCE-sexta-manha" type="checkbox" name="sexta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana manha" id="Remoto-sexta-manha" type="checkbox" name="sexta" value="Remoto" />Remoto</label>
			</div>
		</div>
		<hr>
		<div class="row-fluid">
			<div class="span2">
				<h4>Tarde</h4>
			</div>
			<div class="span2">
				<h4>Segunda</h4>
				<label class="horario"><input class="dia-semana tarde" id="105-segunda-tarde" type="checkbox" name="segunda" value="105" />105</label>
				<label class="horario"><input class="dia-semana tarde" id="122-segunda-tarde" type="checkbox" name="segunda" value="122" />122</label>
				<label class="horario"><input class="dia-semana tarde" id="128-segunda-tarde" type="checkbox" name="segunda" value="128" />128</label>
				<label class="horario"><input class="dia-semana tarde" id="FCE-segunda-tarde" type="checkbox" name="segunda" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana tarde" id="Remoto-segunda-tarde" type="checkbox" name="segunda" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Terça</h4>
				<label class="horario"><input class="dia-semana tarde" id="105-terca-tarde" type="checkbox" name="terca" value="105" />105</label>
				<label class="horario"><input class="dia-semana tarde" id="122-terca-tarde" type="checkbox" name="terca" value="122" />122</label>
				<label class="horario"><input class="dia-semana tarde" id="128-terca-tarde" type="checkbox" name="terca" value="128" />128</label>
				<label class="horario"><input class="dia-semana tarde" id="FCE-terca-tarde" type="checkbox" name="terca" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana tarde" id="Remoto-terca-tarde" type="checkbox" name="terca" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Quarta</h4>
				<label class="horario"><input class="dia-semana tarde" id="105-quarta-tarde" type="checkbox" name="quarta" value="105" />105</label>
				<label class="horario"><input class="dia-semana tarde" id="122-quarta-tarde" type="checkbox" name="quarta" value="122" />122</label>
				<label class="horario"><input class="dia-semana tarde" id="128-quarta-tarde" type="checkbox" name="quarta" value="128" />128</label>
				<label class="horario"><input class="dia-semana tarde" id="FCE-quarta-tarde" type="checkbox" name="quarta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana tarde" id="Remoto-quarta-tarde" type="checkbox" name="quarta" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Quinta</h4>
				<label class="horario"><input class="dia-semana tarde" id="105-quinta-tarde" type="checkbox" name="quinta" value="105" />105</label>
				<label class="horario"><input class="dia-semana tarde" id="122-quinta-tarde" type="checkbox" name="quinta" value="122" />122</label>
				<label class="horario"><input class="dia-semana tarde" id="128-quinta-tarde" type="checkbox" name="quinta" value="128" />128</label>
				<label class="horario"><input class="dia-semana tarde" id="FCE-quinta-tarde" type="checkbox" name="quinta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana tarde" id="Remoto-quinta-tarde" type="checkbox" name="quinta" value="Remoto" />Remoto</label>
			</div>
			<div class="span2">
				<h4>Sexta</h4>
				<label class="horario"><input class="dia-semana tarde" id="105-sexta-tarde" type="checkbox" name="sexta" value="105" />105</label>
				<label class="horario"><input class="dia-semana tarde" id="122-sexta-tarde" type="checkbox" name="sexta" value="122" />122</label>
				<label class="horario"><input class="dia-semana tarde" id="128-sexta-tarde" type="checkbox" name="sexta" value="128" />128</label>
				<label class="horario"><input class="dia-semana tarde" id="FCE-sexta-tarde" type="checkbox" name="sexta" value="FCE" />FCE</label>
				<label class="horario"><input class="dia-semana tarde" id="Remoto-sexta-tarde" type="checkbox" name="sexta" value="Remoto" />Remoto</label>
			</div>
		</div>
	</form>
<?php else:?>
	<b>Você precisa estar logado para alterar a agenda</b>
<?php endif;?>

<div class="verde"></div>
<!--<hr>
<h4 style="text-align:center; background-color:gray; padding: 10px 0; color: #FFFFFF;"><b>Agenda de Trabalho</b></h4>
<div id="agenda"></div>-->

