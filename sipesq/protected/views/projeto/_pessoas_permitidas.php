<div id="pessoas-permitidas">
	<table>
	<tr>
	<th>Pessoa</th><th>Nível de Permissão</th><th>Remover</th>
	</tr>
	<?php foreach ($data as $p):?>
	<tr class="permissoes">
			<td>
				<?php echo CHtml::link(CHtml::encode($p->pessoa->nome), array('pessoa/view', 'id'=>$p->cod_pessoa)); ?>
			</td>
			
			<td>
				<?php echo CHtml::encode($p->nivel); ?>
			</td> 
			<td>
				<?php //echo CHtml::submitButton('Remover', array('submit'=>array('deletePermissao','cod_projeot'=>$p->cod_projeto, 'cod_pessoa'=>$p->cod_pessoa,'returnUrl'=>array($this->route)) ,'confirm'=>'Deseja remover esta permissão?')); ?>
				<?php echo ajaxSubmitButton("Remover", array('deletePermissao'), array('update'=>'#pessoas-permitidas'), array('returnUrl'=>array($this->route) ,'confirm'=>'Deseja remover esta permissão?'))?>
				<?php echo $this->createUrl('deletePermissao', array('cod_projeot'=>$p->cod_projeto, 'cod_pessoa'=>$p->cod_pessoa))?>
			</td>
	</tr>
	<?php endforeach;?>
	</table>
</div>