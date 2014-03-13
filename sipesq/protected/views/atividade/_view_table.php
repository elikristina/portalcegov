<tr class="atividade <?php echo $data->class;?>" id="<?php echo $data->cod_atividade ?>">

	<td>
	 <?php //echo CHtml::link(CHtml::encode($data->nome_atividade), array('atividade/view', 'id'=>$data->cod_atividade)); ?>
	 <?php echo CHtml::encode($data->nome_atividade);?>
	</td>

	<td>
	<?php if(is_object($data->categoria)):?>
	<?php if($data->categoria->categoriaPai->cod_categoria != $data->categoria->cod_categoria ):?>
		<?php echo CHtml::encode($data->categoria->categoriaPai->nome);?> <b>&gt;</b> 
	<?php endif;?>
	 <?php echo CHtml::encode($data->categoria->nome);?>
	<?php endif;?>
	</td>

	<td>
	<?php echo CHtml::encode($data->responsavel->nome); ?>
	</td>
		
	<td>
	<?php echo CHtml::encode($data->data_fim);?>
	</td>
	
</tr>