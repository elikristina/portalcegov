<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/atividades.js')?>
<div class="row-fluid">
<fieldset>
	<div class="span8">
		<label>Projeto</label>
		<?php 
			$projetos = array();
			if(Sipesq::getPermition('projeto.atividades') >= 1)
				$projetos = Projeto::model()->findAll(array('order'=>'nome'));
			else
				$projetos = $data->projetos_atuante;

		echo CHtml::dropDownList(
					'projeto'
				,	null
				,	CHtml::listData($projetos, 'cod_projeto', 'nome', 'situacao_text')
				,	array('data-target'=>'pessoa', 'class'=>'input-xxlarge', 'id'=>'atv-projeto', 'prompt'=>'Selecione o Projeto')
			)
		?>
	
	<label>Categoria</label>
	<?php echo CHtml::dropDownList(
				'categoria'
			,	null
			,	CHtml::listData(AtividadeCategoria::model()->findAll(array('order'=>'nome')), 'cod_categoria', 'nome', 'categoriaPai.nome')
			,	array('id'=>'atv-categoria','data-target'=>'categoria', 'class'=>'input-xxlarge', 'prompt'=>'Selecione a Categoria')
		)
	?>
	<?php if(Sipesq::getPermition('projeto.atividades') >= 1): ?>
		<label>Pessoa</label>
		<?php echo CHtml::dropDownList(
					'categoria'
				,	Yii::app()->user->getId()
				,	CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome')
				,	array('id'=>'atv-pessoa','data-target'=>'pessoa', 'class'=>'input-xxlarge', 'prompt'=>'Selecione uma Pessoa')
			)
		?>
	<?php endif; ?>
	<br>
	<?php echo CHtml::link('Adicionar Atividade', array('/atividade/create'), array('class'=>'btn btn-primary')); ?>
	</div>	
	<div class="span4">
		<label>Finalizada</label>
		<?php //echo CHtml::checkBox('finalizado',true, array('id'=>"atv-finalizado", 'data-target'=>'finalizado'))?>
		<?php /* echo CHtml::dropDownList('status', null, array('0'=>"A Fazer",'2'=>"Finalizada"), array('id'=>"atv-status", 'data-target'=>'status', 'prompt'=>'Selecione um status')) */?>

		<?php echo CHtml::checkBox('estagio', false, array('id'=>"atv-estagio", 'data-target'=>'estagio')); ?>
		
		<label>Respoonsável / Participante</label>
		<?php echo CHtml::dropDownList('responsavel', null, array('0'=>"Participante",'1'=>"Responsável"), array('id'=>"atv-responsavel", 'data-target'=>'responsavel'))?>
	</div>
</fieldset>
</div>


<div id="atv-json"></div>
<div id="more-atv"></div>
<script>

(function(){

	var options = {
		pessoa: <?php echo $data->cod_pessoa?>
		, estagio: false
	};
	var atividade = new Atividade('#atv-json', options);

	atividade.load(options);

	$('#atv-load-more').click(function(){
		atividade.load();
	});

	
	$('#atv-projeto').change(function(){
		$('#atv-json').html('');
		options.projeto = $(this).val();
		options.count = 0;
		atividade.load(options);
		
	});

	$('#atv-estagio').change(function(){
		$('#atv-json').html('');
		options.estagio = this.checked;
		console.log(options.estagio);
		options.count = 0;
		atividade.load(options);
	});

	$('#atv-categoria').change(function(){
		$('#atv-json').html('');
		options.categoria = $(this).val();
		options.count = 0;
		atividade.load(options);
		
	});

	$('#atv-pessoa').change(function(){
		$('#atv-json').html('');
		options.pessoa = $(this).val();
		options.count = 0;
		atividade.load(options);
		
	});


	$('#atv-responsavel').change(function(){
		$('#atv-json').html('');
		if($(this).val() == '1'){
			options.responsavel = options.pessoa;
			options.pessoa = '';
		}
		
		if($(this).val() == '0'){
			options.pessoa = options.responsavel;
			options.responsavel = '';
		}
		options.count = 0;
		atividade.load(options);
		
	});

	
})();

</script>