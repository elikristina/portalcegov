<!-- A fazer: 
	- Ajeitar os  Checkbox
	- Incluir os passos nas atividades
	- passos finalizados
	- Ajeitar o nome das pessoas
	- Melhorar o codigo
	-->

<script>
function filtraPessoas  (){
    	var url = '?';

		var pessoa = encodeURIComponent($('#dropDownPessoa').val());
		if(pessoa)
    		url += '&idPessoa=' + pessoa;
		
    	var pessoais = document.getElementById('checkBoxInformacoesPessoais').checked;
    	if(!pessoais)
    		url += '&pessoais=' + 0;

    	var bancarias = document.getElementById('checkBoxInformacoesBancarias').checked;
    	if(!bancarias)
    		url += '&bancarias=0';

    	var projetos = document.getElementById('checkBoxProjetos').checked;
    	if(!projetos)
    		url += '&projetos=0';

    	var bolsas = document.getElementById('checkBoxBolsas').checked;
    	if(!bolsas)
    		url += '&bolsas=0';

    	var atividadesParticipa = document.getElementById('checkBoxAtividadesParticipa').checked;
    	if(!atividadesParticipa)
    		url += '&atividadesParticipa=0';

    	var atividadesParticipaFinalizadas = document.getElementById('checkBoxAtividadesParticipaFinalizadas').checked;
    	if(!atividadesParticipaFinalizadas)
    		url += '&atividadesParticipaFinalizadas=0';

    	var atividadesParticipaPassos = document.getElementById('checkBoxAtividadesParticipaPassos').checked;
    	if(!atividadesParticipaPassos)
    		url += '&atividadesParticipaPassos=0';

    	var atividadesResponsavel = document.getElementById('checkBoxAtividadesResponsavel').checked;
    	if(!atividadesResponsavel)
    		url += '&atividadesResponsavel=0';

    	var atividadesResponsavelFinalizadas = document.getElementById('checkBoxAtividadesResponsavelFinalizadas').checked;
    	if(!atividadesResponsavelFinalizadas)
    		url += '&atividadesResponsavelFinalizadas=0';

    	var atividadesResponsavelPassos = document.getElementById('checkBoxAtividadesResponsavelPassos').checked;
    	if(!atividadesResponsavelPassos)
    		url += '&atividadesResponsavelPassos=0';
		
		var inicio = encodeURIComponent($('#inicio').val());
		if(inicio)
    		url += '&inicio=' + inicio;
		
    	var termino = encodeURIComponent($('#termino').val());
    	if(termino)
    		url += '&termino=' + termino;

    	location.href = url;
	}
</script>
<script type="text/javascript">
	function setCheckBoxDisabled(status){
		var name = status.id;
		var nameFinalizadas = name+"Finalizadas";
		var namePassos = name+"Passos";
		if (document.getElementById(name).checked){
			document.getElementById(nameFinalizadas).disabled = false;
			document.getElementById(namePassos).disabled = false;
		}
		else{
			document.getElementById(nameFinalizadas).disabled = true;
			document.getElementById(namePassos).disabled = true;
		}
		
	}
</script>
 
<?php
$this->breadcrumbs=array(
	'Relatório de Pessoas',
);

$this->menu=array(
	array('label'=>'Relatório de Atividades', 'url'=>array('atividade')),
	array('label'=>'Relatório de Projetos', 'url'=>array('projeto')),
	array('label'=>'Relatório de Pessoas', 'url'=>array('pessoas')),
);
?>

<h1>Relatório de Pessoas</h1>


<div class="row">
<?php echo CHtml::dropDownList('dropDownPessoa',$idPessoa,CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Todos",));?>
</div>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxInformacoesPessoais',$pessoais);?><b> Exibir Informações Pessoais</b>
</div>
<br>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxInformacoesBancarias',$bancarias);?><b> Exibir Informações Bancarias</b>
</div>
<br>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxProjetos',$projetos);?><b> Exibir Projetos em que atua</b>
</div>
<br>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxBolsas',$bolsas);?><b> Exibir bolsas e outros recebimentos</b>
</div>
<br>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxAtividadesParticipa',$atividadesParticipa, array('onclick'=>"setCheckBoxDisabled(this)"));?><b> Exibir Atividades que participa</b>
</div>
<br>

<div class="checkboxDependente">
<?php echo CHtml::checkBox('checkBoxAtividadesParticipaFinalizadas',$atividadesParticipaFinalizadas);?><b> Exibir atividades finalizadas</b>
</div>
<br>

<div class="checkboxDependente">
<?php echo CHtml::checkBox('checkBoxAtividadesParticipaPassos',$atividadesParticipaPassos);?><b> Exibir Passos</b>
</div>
<br>

<div class="checkbox">
<?php echo CHtml::checkBox('checkBoxAtividadesResponsavel',$atividadesResponsavel, array('onclick'=>"setCheckBoxDisabled(this)"));?><b> Exibir Atividades pelas quais é Responsavel</b>
</div>
<br>

<div class="checkboxDependente">
<?php echo CHtml::checkBox('checkBoxAtividadesResponsavelFinalizadas',$atividadesResponsavelFinalizadas);?><b> Exibir atividades finalizadas</b>
</div>
<br>

<div class="checkboxDependente">
<?php echo CHtml::checkBox('checkBoxAtividadesResponsavelPassos',$atividadesResponsavelPassos);?><b> Exibir Passos</b>
</div>
<br>

<div class="row">
<label><b>Inicio - Término</b></label>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'inicio',
				'value'=>isset($inicio) ? $inicio : null,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop',),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
 -
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    			'name'=>'termino',
				'value'=>isset($termino) ? $termino : null,
				'language'=>'pt-BR',
			    // additional javascript options for the date picker plugin
    			'options'=>array('showAnim'=>'drop',),
			    'htmlOptions'=>array('style'=>'height:15px;'),));
		?>
</div>

<script type="text/javascript">
setCheckBoxDisabled(checkBoxAtividadesResponsavel);
setCheckBoxDisabled(checkBoxAtividadesParticipa);
</script>
		
<?php echo CHtml::submitButton('Limpar', array('id'=>'btnLimpar', 'submit'=>'pessoas'));?>
<?php echo CHtml::submitButton('Enviar', array('id'=>'btnEnviar', 'onclick'=>'filtraPessoas();'));?>

<div class="view" id="chart_pessoas"></div>
<br>
<?php foreach ($pessoas as $pessoa)
	{?>
	<br/>
	<a id="info"></a>
	<p align="center" style="font-size:20px"><b><?php echo CHtml::encode($pessoa->nome);?></b></p>
	<div class="view">
		<?php 
		if($pessoais){
			$this->renderPartial('/pessoa/relatorio/_info_pessoal', array('pessoa'=>$pessoa));
		}
		if ($bancarias){
			$this->renderPartial('/pessoa/relatorio/_info_bancaria', array('pessoa'=>$pessoa));
		}
		if($projetos){
			$this->renderPartial('/pessoa/relatorio/_info_academica', array('pessoa'=>$pessoa));
		}
		if($bolsas){
			$this->renderPartial('/pessoa/relatorio/_info_recebimentos', array('pessoa'=>$pessoa));
		}
		if ($atividadesResponsavel){
			$this->renderPartial('/pessoa/relatorio/_info_atividades_responsavel', array('pessoa'=>$pessoa, 
																						'atividadesResponsavelFinalizadas'=>$atividadesResponsavelFinalizadas,
																						'atividadesResponsavelPassos'=>$atividadesResponsavelPassos,
																						'inicio'=>$inicio,
																						'termino'=>$termino));
		} 
		if ($atividadesParticipa)
		{
			$this->renderPartial('/pessoa/relatorio/_info_atividades_participa', array('pessoa'=>$pessoa,
 																						'atividadesParticipaFinalizadas'=>$atividadesParticipaFinalizadas,
																						'atividadesParticipaPassos'=>$atividadesParticipaPassos,
																						'inicio'=>$inicio,
																						'termino'=>$termino));
		}?>
	</div>
	<?php } ?>
	



