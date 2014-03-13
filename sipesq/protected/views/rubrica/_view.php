<?php
/* @var $this RubricaController */
/* @var $data Rubrica */


?>
<tr><td>
	<h5><?php echo CHtml::link(CHtml::encode($data->nome), array('view', 'id'=>$data->cod_rubrica)); ?></h5>
	
	<?php if(count($data->filhas) > 0):?>
		<b>Filhas</b>
		<ul>
		 <?php foreach($data->filhas as $filha):?>
		 	<li><?php echo CHtml::link(CHtml::encode($filha->nome), array('view', 'id'=>$filha->cod_rubrica))?></li>
		 <?php endforeach;?>
		 </ul>
	<?php endif;?>
</td>
<td><?php echo CHtml::encode($data->numero)?></td>
<td>
			<?php echo CHtml::link("<i class='icon icon-search'></i>",array('view', 'id'=>$data->cod_rubrica), array('class'=>'link tip', 'title'=>'Mais Informações'));?>
			<?php echo CHtml::link("<i class='icon icon-pencil'></i>",array('update', 'id'=>$data->cod_rubrica) ,array('title'=>'Editar', 'class'=>'tip'))?>
			<?php echo CHtml::link("<i class='icon icon-trash'></i>",'#', array(
				'submit'=>array('delete', 'id'=>$data->cod_rubrica),
				'confirm'=>"Você deseja deletar esta rubrica?",
				'class'=>'tip',
				'title'=>'Excluir'
			))?>
			
</td>
</tr>