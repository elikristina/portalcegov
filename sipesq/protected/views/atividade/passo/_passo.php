<div class="kanban-passo-item" rel="popover" data-placement="bottom" data-title="<?php echo $model->pessoa->nome ?>" data-content="Prazo: <?php echo $model->data_prazo ?>	">
<?php echo CHtml::checkBox('',$model->finalizado ,array('id'=>$model->cod_passo, 'class'=>'ok-button'))?>&nbsp;
<?php echo CHtml::encode($model->descricao); ?>
<?php if(strtotime(date('Y-m-d')) >= strtotime($model->data_prazo)):?>
&nbsp;<i data-placement="top" title="Tarefa Atrasada" class="icon icon-exclamation-sign vermeelho"></i>
<?php endif;?>

<?php /*
(<?php echo CHtml::encode($model->pessoa->nome_curto); ?>)<br/>
<i class="icon icon-calendar" title="Prazo" rel="tooltip"></i>
	<?php echo CHtml::encode($model->data_prazo); ?>
<br />
*/?>

</div>
<hr>

