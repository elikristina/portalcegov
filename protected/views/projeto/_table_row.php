<tr>
	<td><?php echo CHtml::link(CHtml::encode($data->t('nome')), array('/projeto/view', 'id'=>$data->cod_projeto)); ?></td>
	<td><?php echo CHtml::link(CHtml::encode($data->gt->t('nome')), array('/gt/view', 'id'=>$data->gt->cod_gt))?></td>
</tr>
