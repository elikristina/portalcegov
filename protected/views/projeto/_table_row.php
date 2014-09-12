<tr>
	<td class="span7"><?php echo CHtml::link(CHtml::encode($data->t('nome')), array('/projeto/view', 'id'=>$data->cod_projeto)); ?></td>
	<td class="span5"><?php echo CHtml::link(CHtml::encode($data->gt->t('nome')), array('/gt/view', 'id'=>$data->gt->cod_gt))?></td>
</tr>

