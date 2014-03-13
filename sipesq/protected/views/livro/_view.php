<div class="view">

	<b><?php echo CHtml::link(CHtml::encode($data->titulo), array('view', 'id'=>$data->cod_livro)); ?></b>
	<br />
	<?php /*
	<?php if($data->subtitulo != ''):?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('subtitulo')); ?>:</b>
	<?php echo CHtml::encode($data->subtitulo); ?>
	<br />
	<?php endif;?>
	*/?>
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('autor')); ?>:</b>
	<?php echo CHtml::encode($data->autor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ano')); ?>:</b>
	<?php echo CHtml::encode($data->ano); ?>
	<br />
		
	<b><?php echo CHtml::encode($data->getAttributeLabel('cod_projeto')); ?>:</b>
	<?php echo CHtml::encode($data->projeto->nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('editora')); ?>:</b>
	<?php echo CHtml::encode($data->editora); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade_publicacao')); ?>:</b>
	<?php echo CHtml::encode($data->cidade_publicacao); ?>
	<br />
	
	<?php if($data->estaEmprestado()):?>
		<?php echo CHtml::submitButton('Devolver', array('submit'=>array('devolucao','id'=>$data->cod_livro),'confirm'=>'Deseja devolver este livro?', 'class'=>'btn btn-small btn-primary')); ?>
	<?php else:?>
		<?php echo CHtml::submitButton('Emprestar', array('submit'=>array('emprestimo','id'=>$data->cod_livro), 'class'=>'btn btn-small')); ?>
<?php endif;?>
	
</div>