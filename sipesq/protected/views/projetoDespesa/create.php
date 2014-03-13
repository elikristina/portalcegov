<?php
/* @var $this ProjetoDespesaController */
/* @var $model ProjetoDespesa */

$this->breadcrumbs=array(
	'Projetos'=>array('/projeto/index'),
	$verba->projeto->nome=>array('/projeto/view', 'id'=>$verba->projeto->cod_projeto),
	'Receita ' .$verba->cod_verba=>array('/projetoVerba/view', 'id'=>$verba->cod_verba),
	'Adicionar Despesa',
);

$this->menu=array(
	array('label'=>'Voltar ao Projeto', 'url'=>array('/projeto/view', 'id'=>$verba->projeto->cod_projeto)),
);


Yii::app()->clientScript->registerScript('loadRubrica', 
		"
		$('#drop-rubricas').change(
		function(){

				console.log('Carregando campos adicionais');
				
			if(this.options[this.selectedIndex].value == ''){
			$('#campos-adicionais').html('');
			return;
			}
			$.get('/sipesq/index.php/projetoDespesa/formAdicional/' + this.options[this.selectedIndex].value
			, function(data){
					$('.hidden').hide();
					var content = document.createElement('div');
					//$(content).addClass('alert alert-info');
					$(content).append(data);
					$('#campos-adicionais').html(content);
					$('.hidden').show('fast');
				
			});
			
			//Carrega informacoes sobre a rubrica
			$.getJSON('/sipesq/index.php/projetoDespesa/infoRubrica/'
			,{
			 	id: this.options[this.selectedIndex].value,
				cod_verba: {$verba->cod_verba}
			 }
			, function(data){
					var content = document.createElement('div');
					$(content).addClass('well well-small');
					$(content).append('<b>' + data.descricao + '</b>');
					$('#descricao-rubrica').html(content);
					$('#saldo-disp').html(data.saldo);
				
			});
		
		});
	");

?>
<div class="row-fluid">
<div class="span12">

<h1>Adicionar Despesa</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'verba'=>$verba)); ?>

</div>
</div>