<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/rubrica.orcamento.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('orcamento',"
			
		orcamento = new Orcamento();
		
		$('#btnOrcamento').click(function(){
			orcamento.createField();
		});
		
		$('.tip').tooltip();
		
		$('.icon-trash').click(function(){
		console.log('teste');
			rubTarget = $(this).attr('data-remove-target'); 
			$(rubTarget).remove();
		});
		
");

//Carrega máscara para moedas
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl .'/js/jquery.maskMoney.js');
Yii::app()->clientScript->registerScript('currency', "

$('.money').maskMoney({thousands:'.', decimal:','});

		$('#projeto-form').submit(function(){
		$.each($('.money'), function(i,obj){
				$(obj).val($(obj).val().replace(/\./g,'').replace(',','.'));
			}
			);
		});
");
?>
<fieldset><legend>Orçamento</legend>
	<div id="orcamento" data-count="<?php echo count($model->orcamentos); ?>">
		<?php echo CHtml::dropDownList('Rubrica', null, CHtml::listData(Rubrica::model()->findAll(array('order'=>'nome')), 'cod_rubrica', 'nome'), array('class'=>'input-xxlarge', 'id'=>'list-rubricas'));?>
		<div class="input-prepend input-append">
  			<span class="add-on">R$</span>
  			<?php echo CHtml::textField('Rubrica_valor', 0, array('class'=>'money input-small', 'id'=>'rubrica-valor'))?>
  			<span class="add-on"><?php echo CHtml::link('Adicionar','', array('id'=>'btnOrcamento'))?></span>
		</div><hr>
		
		<table class="table table-bordered table-striped table-hover">
			<thead>
				<tr>
					<th>Rubrica</th>
					<th>Valor Orçamentado (R$)</th>
					<?php if(Sipesq::getPermition('projeto.financeiro') >= 100) :?>
					<th></th>
					<?php endif; ?>
				</tr>
			</thead>
			<tbody id="table-orcamento">
			<?php foreach($model->orcamentos as $k=>$orc):?>
				<tr class="item-<?php echo $orc->cod_rubrica?>">
					<td><?php echo $orc->rubrica->nome ?></td>
					<td><?php echo number_format($orc->valor, 2, ',','.') ?></td>
					<?php if(Sipesq::getPermition('projeto.financeiro') >= 100) :?>
					<td><i class="icon icon-trash tip" data-remove-target=".item-<?php echo $orc->cod_rubrica?>" title="Remover"></i></td>
					<?php endif; ?>
				</tr>
			<?php endforeach;?>
			</tbody>
		</table>

	
		<?php foreach($model->orcamentos as $i=>$orc):?>
			<?php echo CHtml::hiddenField('Orcamento[' .$i .'][valor]', $orc->valor, array('class'=>'item-' .$orc->cod_rubrica))?>
			<?php echo CHtml::hiddenField('Orcamento[' .$i .'][cod_rubrica]', $orc->cod_rubrica, array('class'=>'item-' .$orc->cod_rubrica))?>
		<?php endforeach;?>
	</div>
	</fieldset>