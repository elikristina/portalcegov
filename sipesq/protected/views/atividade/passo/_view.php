<?php /* @var $model AtividadePasso 
<div id="passo-<?php echo $model->cod_passo?>" style="margin-bottom: 5px;">
	<div class="passo" style="padding: 5px;">
		<i class="icon icon-check" title="Atividade Finalizada" rel="tooltip"></i> 
		<?php echo CHtml::checkBox('',$model->finalizado ,array('id'=>$model->cod_passo, 'class'=>'ok-button'))?>
		<br/>
		
		<i class="icon icon-info-sign" title="Descrição" rel="tooltip"></i>		
		<span class="label <?php echo $model->finalizado ? 'label-success' : 'label-info'?>">
			<?php echo CHtml::encode($model->descricao); ?>
		</span>
		<br />
		
		<i class="icon icon-user" title="Responsável" rel="tooltip"></i>
		<?php echo CHtml::encode($model->pessoa->nome); ?>
		<br />
		<?php /*
		<b>Criação: </b>
		<i class="icon icon-calendar" title="Data de Criação" rel="tooltip"></i>
		<?php echo CHtml::encode($model->data_criacao); ?>
		
		<br />
		?>
		<?php if($model->finalizado):?>
			<i class="icon icon-calendar" title="Data de Conclusao" rel="tooltip"></i>
			<?php echo CHtml::encode(Sipesq::date($model->data_finalizacao)); ?>
			<br />
		<?php else:?>
			<i class="icon icon-calendar" title="Prazo" rel="tooltip"></i>
			<?php echo CHtml::encode(Sipesq::date($model->data_prazo)); ?>
			<br />
		<?php endif;?>
		<a class="btnEditAtv" href="<?php echo $this->createUrl('/atividade/updatePasso/', array('id'=>$model->cod_passo, 'layout'=>0))?>" data-toggle="modal" data-target="#modalAtvEdit" data-replace="#passo-<?php echo $model->cod_passo;?>"><i class="icon icon-pencil" rel="tooltip" title="Editar"></i></a>
		<a class="btnDeleteCampo" data-href="<?php echo $this->createUrl('/atividade/deletePasso/', array('layout'=>0, 'id'=>$model->cod_passo))?>" data-cod-passo="<?php echo $model->cod_passo;?>"><i class="icon icon-trash" rel="tooltip" title="Excluir" ></i></a>
	</div>
</div>
*/ ?>


<div class="panel <?php echo $model->finalizado ? "panel-success" : "panel-info" ?>" id="passo-<?php echo $model->cod_passo?>">
  <div class="panel-heading">
  	<div class="row-fluid">
  		<div class="span11">
  			<h5 class="panel-title"><?php echo CHtml::encode($model->descricao); ?></h5>
  		</div>
  		<div class="span1">  			
  			 <?php echo CHtml::checkBox('',$model->finalizado ,array('id'=>$model->cod_passo, 'class'=>'ok-button', 'title'=>$model->finalizado ? "Abrir Passo" : "Concluir Passo", 'rel'=>'tooltip'))?>
  		</div>
  	</div>
    

  </div>
  <div class="panel-body">
    			<?php /*
    			<i class="icon icon-check" title="Atividade Finalizada" rel="tooltip"></i> 
		<?php echo CHtml::checkBox('',$model->finalizado ,array('id'=>$model->cod_passo, 'class'=>'ok-button'))?>
		<br/>

		<i class="icon icon-info-sign" title="Descrição" rel="tooltip"></i>		
		<span class="label <?php echo $model->finalizado ? 'label-success' : 'label-info'?>">
			<?php echo CHtml::encode($model->descricao); ?>
		</span>
		<br />
			<i class="icon icon-calendar" title="Data de Criação" rel="tooltip"></i>
		<?php echo CHtml::encode($model->data_criacao); ?>
		<br />
		*/?>
		
		
		
	
		
		<i class="icon icon-user" title="Responsável" rel="tooltip"></i>
		<?php echo CHtml::encode($model->pessoa->nome); ?>
		<br />

		<?php if($model->finalizado):?>
			<i class="icon icon-calendar" title="Data de Conclusao" rel="tooltip"></i>
			<?php echo CHtml::encode(Sipesq::date($model->data_finalizacao)); ?>
			<br />
		<?php else:?>
			<i class="icon icon-calendar" title="Prazo" rel="tooltip"></i>
			<?php echo CHtml::encode(Sipesq::date($model->data_prazo)); ?>
			<br />
		<?php endif;?>
		<a class="btnEditAtv" href="<?php echo $this->createUrl('/atividade/updatePasso/', array('id'=>$model->cod_passo, 'layout'=>0))?>" data-toggle="modal" data-target="#modalAtvEdit" data-replace="#passo-<?php echo $model->cod_passo;?>"><i class="icon icon-pencil" rel="tooltip" title="Editar"></i></a>
		<a class="btnDeleteCampo" data-href="<?php echo $this->createUrl('/atividade/deletePasso/', array('layout'=>0, 'id'=>$model->cod_passo))?>" data-cod-passo="<?php echo $model->cod_passo;?>"><i class="icon icon-trash" rel="tooltip" title="Excluir" ></i></a>
  </div>
</div>