<?php
/* @var $this GrupoController */
/* @var $data Grupo */
?>
<dt>
<?php echo CHtml::link(CHtml::encode($data->nome), array('update', 'id'=>$data->cod_grupo)); ?>

</dt>
<dd><?php echo CHtml::encode($data->descricao)?></dd>
<dd><a data-toggle="modal"  data-target="#modal" class="modal-trigger" href="<?php echo $this->createUrl('pessoas', array('id'=>$data->cod_grupo))?>"><i class="icon icon-group"></i> Pessoas</a></dd>
<br>