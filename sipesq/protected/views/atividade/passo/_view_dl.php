<dl class="dl-horizontal" id="passo-<?php echo $model->cod_passo?>">
  <dt><i class="icon icon-user" title="Responsável" rel="tooltip"></i><?php echo $model->pessoa->nome?></dt>
  <dd>
  	<i class="icon icon-info-sign" title="Descrição" rel="tooltip"></i>
   	<?php echo CHtml::encode($model->descricao); ?>
  </dd>
  <dd>
  	<i class="icon icon-check" title="Atividade Finalizada" rel="tooltip"></i> 
	<?php echo CHtml::checkBox('',$model->finalizado ,array('id'=>$model->cod_passo, 'class'=>'ok-button'))?>
  </dd>
 <dd>
 	<a class="btnEditAtv" href="<?php echo $this->createUrl('/atividade/updatePasso/', array('id'=>$model->cod_passo, 'layout'=>0))?>" data-toggle="modal" data-target="#modalAtvEdit" data-replace="#passo-<?php echo $model->cod_passo;?>"><i class="icon icon-pencil" rel="tooltip" title="Editar"></i></a>
	<a class="btnDeleteCampo" data-href="<?php echo $this->createUrl('/atividade/deletePasso/', array('layout'=>0, 'id'=>$model->cod_passo))?>" data-cod-passo="<?php echo $model->cod_passo;?>"><i class="icon icon-trash" rel="tooltip" title="Excluir" ></i></a>
	<?php if($model->finalizado):?>
				<i class="icon icon-calendar" title="Data de Conclusao" rel="tooltip"></i>
				<?php echo CHtml::encode(Sipesq::date($model->data_finalizacao)); ?>
		<?php else:?>
			<i class="icon icon-calendar" title="Prazo" rel="tooltip"></i>
			<?php echo CHtml::encode(Sipesq::date($model->data_prazo)); ?>
 <?php endif;?>
</dd>
</dl>
<?php /* @var $model AtividadePasso */ ?>

		
		
		
		
