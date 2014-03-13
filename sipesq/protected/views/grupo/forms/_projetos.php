<?php /* @var PermissaoProjetoForm $projeto */ ?>
<h4>Permissões da Página dos Projetos</h4>
<div class="row-fluid">
	<div class="span6">
		<?php echo $form->labelEx($projeto,'informacoes'); ?>
		<?php echo $form->dropDownList($projeto, 'informacoes', Grupo::defaultPermitions());?>
		<?php echo $form->error($projeto,'informacoes'); ?>
	
		<?php echo $form->labelEx($projeto,'atividades'); ?>
		<?php echo $form->dropDownList($projeto, 'atividades', Grupo::defaultPermitions());?>
		<?php echo $form->error($projeto,'atividades'); ?>
	
		<?php echo $form->labelEx($projeto,'financeiro'); ?>
		<?php echo $form->dropDownList($projeto, 'financeiro', Grupo::defaultPermitions());?>
		<?php echo $form->error($projeto,'financeiro'); ?>
	
		<?php echo $form->labelEx($projeto,'documentos'); ?>
		<?php echo $form->dropDownList($projeto, 'documentos', Grupo::defaultPermitions());?>
		<?php echo $form->error($projeto,'documentos'); ?>
	
		<?php echo $form->labelEx($projeto,'gerencial'); ?>
		<?php echo $form->dropDownList($projeto, 'gerencial', Grupo::binaryPermitions());?>
		<?php echo $form->error($projeto,'gerencial'); ?>
		
		<?php echo $form->labelEx($projeto,'deletar'); ?>
		<?php echo $form->dropDownList($projeto, 'deletar', Grupo::binaryPermitions());?>
		<?php echo $form->error($projeto,'deletar'); ?>
	</div>
	
	<div class="span6">
		<h5>Rubricas</h5>
		<?php $data = CHtml::listData(Rubrica::model()->findAll(array('select'=>'cod_rubrica, nome')), 'cod_rubrica', 'nome')?>
		<?php echo CHtml::dropDownList("Rubrica", null, $data, array('id'=>'rubrica_id'))?><br>
		<?php echo CHtml::dropDownList("RubricaPermissao", null, Grupo::binaryPermitions(), array('id'=>'rubrica_permissao'))?><br>
		<?php echo CHtml::button("Adicionar", array('class'=>'btn btn-small', 'id'=>'rubrica_add'))?><br>
		
		<table class="table" id="rubrica_added" style="margin-top: 10px;">
			<tr><th>Rubrica</th><th>Permissão</th><th></th></tr>
			<?php $permition = Grupo::binaryPermitions();?>
			<?php if(isset($projeto->rubricas)):?>
				<?php foreach($projeto->rubricas as $r): ?>
					<?php $rubrica = json_decode($r); ?>
					<tr id="perm_rubrica_<?php echo $rubrica->cod_rubrica?>">
						<td><?php echo $rubrica->nome?></td>
						<td><?php echo $permition[$rubrica->permissao]?></td>
						<td><button class="btn btn-danger btn-small del_perm" data-target="<?php echo $rubrica->cod_rubrica?>">Remover</button></td>	
						<?php echo CHtml::hiddenField("PermissaoProjetoForm[rubricas][]", $r, array('id'=>"PermissaoProjetoForm_rubrica" .$rubrica->cod_rubrica))?>
					</tr>
				<?php endforeach;?>	
			<?php endif;?>				
		</table>
		<div class="view alert-info">
		<p>Observação: Caso o grupo tenha <b>Controle Total</b> da página <b>Financeiro</b> as permissões específicas de rubricas serão ignoradas, pois o grupo já possui controle total desta parte do projeto.
		</div>
	</div>
</div>

<script>
(function(){
	$('.del_perm').click(function(){
		$('#perm_rubrica_' + $(this).attr('data-target')).remove();
	});

	
	$('#rubrica_add').click(function(){
		
		if($('#rubrica_id option').length < 1){
			alert('Não há mais rubricas disponíveis');
			return;	
		}

		if($('#PermissaoProjetoForm_rubrica' +  $('#rubrica_id option:selected').val()).length > 0){
			console.log($('#PermissaoProjetoForm_rubrica' +  $('#rubrica_id option:selected').val()).length);
			alert("Rubrica já adicionada");
			return;
		}
		
		var rubrica = {
			'cod_rubrica': $('#rubrica_id option:selected').val(),
			'nome':$('#rubrica_id option:selected').text(),
			'permissao': $('#rubrica_permissao option:selected').val(),
			'permissao_nome': $('#rubrica_permissao option:selected').text()
		};

		var input = document.createElement('input');
		$(input)
		.attr('type', 'hidden')
		.attr('disable', true)
		.attr('name', 'PermissaoProjetoForm[rubricas][]')
		.attr('id', 'PermissaoProjetoForm_rubrica' + rubrica.cod_rubrica)
		.val(JSON.stringify(rubrica)); 
			
		var item_remove = document.createElement('button');
		$(item_remove).addClass('btn btn-danger btn-small')
		.html("Remover")
		.click(function(){
			
			$('#perm_rubrica_' + rubrica.cod_rubrica).remove();
			$('#rubrica_id').prepend(['<option value="'
			             			, rubrica.cod_rubrica
			             			, '">'
			             			,rubrica.nome
			             			,'</option>'].join('')); 

			 
		});

		var container = document.createElement('tr');
		$(container).attr('id', 'perm_rubrica_' + rubrica.cod_rubrica)
		.append("<td>" + rubrica.nome + "</td>")
		.append("<td>" + rubrica.permissao_nome + "</td>")
		.append($("<td>").append(item_remove))
		.append(input);

		$('#rubrica_added').append(container);

		//Remove a rubrica ja utilizada
		$('#rubrica_id option:selected').remove();
	}); 
})();




</script>