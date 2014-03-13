<?php
$this->breadcrumbs=array(
	'Atividade Categorias',
);

$this->menu=array(
	array('label'=>'Adicionar', 'url'=>array('create')),
	array('label'=>'Gerenciar', 'url'=>array('admin')),
);
?>

<h3>Categorias de Atividades</h3>

<div class="view">
<ul style="list-style: none;">
<?php foreach($categoriasPrimarias as $cPrimaria):?>
<li>
	<b><?php echo CHtml::link(CHtml::encode($cPrimaria->nome), array('update', 'id'=>$cPrimaria->cod_categoria)); ?></b>
	<ul style="list-style: none;">
		<?php foreach ($cPrimaria->secundarias as $cSecundaria):?>
		<li>
			<?php if($cSecundaria->cod_categoria != $cSecundaria->cod_categoria_pai):?>
				<?php echo CHtml::link(CHtml::encode($cSecundaria->nome), array('update', 'id'=>$cSecundaria->cod_categoria)); ?>
			<?php endif;?>
		</li>
		<?php endforeach;?>
	</ul>
</li>
<?php endforeach;?>
</ul>
</div>