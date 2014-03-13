<?php
$this->breadcrumbs=array(
	'Agenda',
);?>
<?php Yii::app()->clientScript->registerScript('renderAgenda',"
function renderizaAgenda(){
$.get('/sipesq/index.php/agenda/render/',
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
		$.get('/sipesq/index.php/agenda/ajaxget/', { id: id },
 					function(data) {
 					var horarios = eval(data);
 					
 					for(i=0; i < horarios.length; i++){
 						$('#' + horarios[i].dia_semana + '-' + horarios[i].turno).attr('checked', true);
 					}
 					
 			}, 
 			\"json\");
	});

	$('.manha').change(
	function(){
		if($(this).is(':checked')){
		
			//Adiciona um horario
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).val();
			
			$.get('/sipesq/index.php/agenda/ajaxcreate/', { id: pessoa, turno: 'manha', dia_semana: dia },
 					function() {
 					$('.verde').html('<b>Horário Adicionado com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 					
 			}, 
 			'html');
			
		
			
		}else{
			//Remove um horario
			
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).val();
			
			$.get('/sipesq/index.php/agenda/ajaxdelete/', { id: pessoa, turno: 'manha', dia_semana: dia },
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
			var dia = $(this).val();
			
			$.get('/sipesq/index.php/agenda/ajaxcreate/', { id: pessoa, turno: 'tarde', dia_semana: dia },
 					function() {
 					$('.verde').html('<b>Horário Adicionado com Sucesso</b>');
 					$('.verde').slideDown(300).delay(800).fadeOut(800);
 					renderizaAgenda();
 			}, 
 			'html');
			
		
			
		}else{
			//Remove um horario
			
			var pessoa = $('#drop-pessoa').val();
			var dia = $(this).val();
			
			$.get('/sipesq/index.php/agenda/ajaxdelete/', { id: pessoa, turno: 'tarde', dia_semana: dia },
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
	<?php  echo CHtml::dropDownList('drop_pessoa','cod_pessoa',CHtml::listData(Pessoa::model()->findAll(array('order'=>'equipe_atual DESC, nome')), 'cod_pessoa', 'nome', 'equipe'), array('id'=>'drop-pessoa', 'prompt'=>"Selecione uma pessoa") ); ?>
<?php endif;?>
<div class="centro">

<table>
<tr>
<td>
<?php if(!Yii::app()->user->isGuest):?>
	<form>
	<h4>Manhã</h4>
	<input class="dia-semana manha" id="segunda-manha" type="checkbox" name="segunda" value="segunda" />Segunda<br />
	<input class="dia-semana manha" id="terca-manha" type="checkbox" name="terca" value="terca" />Terça <br>
	<input class="dia-semana manha" id="quarta-manha" type="checkbox" name="quarta" value="quarta" />Quarta <br>
	<input class="dia-semana manha" id="quinta-manha" type="checkbox" name="quinta" value="quinta" />Quinta <br>
	<input class="dia-semana manha" id="sexta-manha" type="checkbox" name="sexta" value="sexta" />Sexta <br>
	<h4>Tarde</h4>
	<input class="dia-semana tarde" id="segunda-tarde" type="checkbox" name="segunda" value="segunda" />Segunda<br />
	<input class="dia-semana tarde" id="terca-tarde" type="checkbox" name="terca" value="terca" />Terça <br>
	<input class="dia-semana tarde" id="quarta-tarde" type="checkbox" name="quarta" value="quarta" />Quarta <br>
	<input class="dia-semana tarde" id="quinta-tarde" type="checkbox" name="quinta" value="quinta" />Quinta <br>
	<input class="dia-semana tarde" id="sexta-tarde" type="checkbox" name="sexta" value="sexta" />Sexta <br>	
	</form>
	<?php else:?>
	<b>Você precisa estar logado para alterar a agenda</b>
	<?php endif;?>
</td>
<td>
	<div id="agenda"></div>
</td>
</tr>
</table>
<div class="verde"></div>







</div>