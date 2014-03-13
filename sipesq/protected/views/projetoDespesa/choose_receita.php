<?php
/* @var $this ProjetoDespesaController */
/* @var $model Projeto */

$this->breadcrumbs=array(
		'Projetos'=>array('/projeto/index'),
		$model->nome=>array('/projeto/view', 'id'=>$model->cod_projeto),
		'Adicionar Despesa',
);

$this->menu=array(
		array('label'=>'Voltar ao Projeto', 'url'=>array('/projeto/view', 'id'=>$model->cod_projeto)),
);

Yii::app()->clientScript->registerScript("popover", "
	$('.tip').css('cursor', 'pointer').tooltip();

	$('.help').click(function(e){
		console.log('click');
 		$('#helpRubricaBody').load($(this).attr('href'));
		$('#helpRubrica').modal({
 				remote: $(this).attr('href')
 			});
 	
	});

	
");

?>

<h3>Selecione uma rubrica</h3>

<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Cuidado!</strong> Valores com <strong style="color: red;">*</strong> podem sofrer redução por compartilharem receita com outras rubricas.
</div>

<?php

function printChildren($rubrica, $receita){
	 		if($rubrica != null){

	 			if(count($rubrica->filhas) < 1){
	 				echo '<li class="rub-item">';
	 				echo CHtml::link('<i class="icon icon-question-sign"></i> ', array('/rubrica/help', 'id'=>$rubrica->cod_rubrica), array('data-toggle'=>'modal', 'data-target'=>'helpRubrica', 'class'=>'help'));
	 				echo CHtml::link($rubrica->numero .' ' .$rubrica->nome
							, array('/projetoDespesa/add', 'id'=>$receita->cod_verba, 'ru'=>$rubrica->cod_rubrica));
					
		 			echo '</li>'; 
	 			}

	 			foreach ($rubrica->filhas as $filha){
	 				printChildren($filha, $receita);
	 			}
	 		}
	 		
	 		
}
?>
<div class="view">
	<ul class="unstyled">
	<?php foreach($model->receitas as $receita):?>
			<?php foreach($receita->rubricas as $rubrica):?>
				<?php 
					$gasto_rubrica = $receita->gastosComprometidos($rubrica);
					$recebido = $gasto_rubrica
					+ min($receita->saldo_comprometido,
							($receita->projeto->getOrcamentado($rubrica->cod_rubrica) - $gasto_rubrica)
								
					);
					$gasto_comprometido = $receita->gastosComprometidos($rubrica);
					$saldo = $recebido - $gasto_comprometido
				?>
				<li>
					<?php echo CHtml::link('<i class="icon icon-question-sign rub-help"></i> ', array('/rubrica/help', 'id'=>$rubrica->cod_rubrica), array('data-toggle'=>'modal', 'data-target'=>'helpRubrica', 'class'=>'help')); ?>
					<b><?php echo $rubrica->numero .' ' .$rubrica->nome?></b>
					<i>
					R$ <?php echo Yii::app()->format->number($saldo)?>
					<?php if(count($receita->rubricas) > 1):?>
						<span style="color: red;" class="tip" title="Receita compartilhada">*</span>
					<?php endif;?>
					disponíveis
					</i>
					<ul><?php echo printChildren($rubrica, $receita) ?></ul>
				</li>
				
			<?php endforeach;?>
	<?php endforeach;?>
	</ul>
</div>


<!-- Button to trigger modal -->
<!-- Modal -->
<div id="helpRubrica" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="helpRubricaLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="helpRubricaLabel">Informações</h3>
  </div>
  <div class="modal-body" id="helpRubricaBody">
    <p>...</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
  </div>
</div>