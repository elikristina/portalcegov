<?php
$this->breadcrumbs=array(
	Yii::t('default', 'equipe')=>array('index'),
	$model->nome,
);

if (Yii::app()->user->name == 'admin') {
	$this->menu=array(
		array('label'=>'<i class="icon-plus"></i> Adicionar Pessoa', 'url'=>array('create')),
		array('label'=>'<i class="icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$model->cod_pessoa)),
		array('label'=>'<i class="icon-trash"></i> Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_pessoa),'confirm'=>'Tem certeza que deseja deletar ' .$model->nome .'?')),
		array('label'=>'<i class="icon-tasks"></i> Gerenciar Pessoas', 'url'=>array('admin')),
 		array('label'=>'<i class="icon-pencil"></i> Trocar Senha', 'url'=>array('changePassword')),
		array('label'=>'<i class="icon-tasks"></i> Restaurar Senha', 'url'=>array('restorePassword', 'id'=>$model->cod_pessoa)),
);
} else {
	$this->menu=array(
		array('label'=>'<i class="icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$model->cod_pessoa)),
		array('label'=>'<i class="icon-trash"></i> Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_pessoa),'confirm'=>'Tem certeza que deseja deletar ' .$model->nome .'?')),
		array('label'=>'<i class="icon-edit"></i> Trocar Senha', 'url'=>array('changePassword')),
);
}

$baseUrl = Yii::app()->request->baseurl;
Yii::app()->clientScript->registerScript('accordion',"

$(function()
{
	$('#tabs a:first').tab('show')
})
")?>

<!--<h1><?php //echo $model->nome; ?></h1>-->

<div class="row-fluid">
	<div class="pull-left" id="view-pessoa-imagem">
		<?php //echo CHtml::image("http://placehold.it/200x200"); ?>
		<?php echo CHtml::image($model->imageLink, 'Imagem pessoal', array('height'=>200, 'width'=>200)); ?>
	</div>
	<div id="view-pessoa-titulo">
		<h3>
			<?php echo $model->nome;?>
		</h3>
		<?php for($i = 0; $i < count($model->categorias); $i++)
			if($i < 3)
				$categorias[] = $model->categorias[$i]->t('nome'); ?>
		<h5><i><?php echo implode(', ', $categorias)?></i></h5>
		<?php if(!Yii::app()->user->isGuest):?>
			<h6><i><?php echo CHtml::mailto($model->email,$model->email, array('target'=>'_blank'));?></i></h6>
		<?php endif;?>
		<?php if($model->lattes != null):?>
			<h6><i><a href="<?php echo $model->lattes ?>" target="_blank"><?php echo Yii::t('Pessoa', 'lattes')?></a></i></h6>
		<?php endif;?>
		<br>		
	</div>
</div> <!-- fim do cabeçalho da página pessoal -->

<div class="row-fluid">
	<div class="span12 tabbable" id="tabs">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#intro" data-toggle="tab"><?php echo Yii::t('Pessoa', 'apresentacao')?></a></li>
			<li><a href="#gts" data-toggle="tab"><?php echo Yii::t('Pessoa', 'gts')?></a></li>
			<li><a href="#pubs" data-toggle="tab"><?php echo Yii::t('Pessoa', 'publicacoes')?></a></li>
			<?php if(Yii::app()->user->name == 'admin'):?>
				<li><a href="#more-info" data-toggle="tab"><?php echo Yii::t('Pessoa', 'info_privadas')?></a></li>
			<?php endif;?>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="intro">
				<?php echo $model->t('descricao');?>
				<?php if(!Yii::app()->user->isGuest): //Link para edição da introdução?>
					
					<?php echo CHtml::link("Editar Apresentação",array("/pessoa/updateApp", 'id'=>$model->cod_pessoa),array('class'=>"btn btn-small btn-primary",));?>
					
				<?php endif;?>
			</div>
			<div class="tab-pane" id="pubs" >
				<p><?php //echo $model->pesquisa;?></p>
				
				<!-- Publicações pelo CEGOV -->
				<?php if(count($model->publicacoes_cegov) > 0):?>
					<h4><?php echo Yii::t('Pessoa', 'publicacoes_cegov')?></h4>
					
					<?php foreach($model->publicacoes_cegov as $publicacao):?>
						<?php   $titulo = substr($publicacao->titulo, 0, 75);
							 	if(strlen($titulo) >= 75)
							 		$titulo .= '...'; ?>
						<div class="pub-list">
						<?php echo CHtml::link($titulo, array('/publicacao/view', 'id'=>$publicacao->cod_publicacao));?>
						</div>
					<?php endforeach;?>
				<?php endif;?>
				
				<br>
				
				<!-- Publicações pessoais -->
				<?php if(count($model->publicacoes_pessoais) > 0):?>
					<h4><?php echo Yii::t('Pessoa', 'publicacoes_fora')?></h4>
					
					<?php foreach($model->publicacoes_pessoais as $publicacao):?>
						<?php   $titulo = substr($publicacao->titulo, 0, 75);
							 	if(strlen($titulo) >= 75)
							 		$titulo .= '...'; ?>
						<div class="pub-list">
						<?php echo CHtml::link($titulo, array('/publicacao/view', 'id'=>$publicacao->cod_publicacao));?>
						</div>
					<?php endforeach;?>
				<?php endif;?>
				
				<?php if(!Yii::app()->user->isGuest): //Link para edição da introdução?>
					<div class="row">
					<?php //echo CHtml::link("Editar Pesquisa",array("/pessoa/updatePesquisa", 'id'=>$model->cod_pessoa),array('class'=>"button",));?>
					</div>
				<?php endif;?>
			</div>
			<div class="tab-pane" id="gts" >
				<?php if(count($model->grupos) > 0):?>
					<h4><?php //echo Yii::t('Pessoa', 'gts')?></h4>
						<?php foreach($model->grupos as $grupo):?>
							<div class="pub-list">
							<?php echo CHtml::link(CHtml::encode($grupo->t('nome')), array('/gt/view', 'id'=>$grupo->cod_gt));?>
							</div>
						<?php endforeach;?>
				<?php else:?>
					<p> Não há Grupos de Trabalho cadastrados.</p>
				<?php endif;?>
			</div>
			<?php if(Yii::app()->user->name == 'admin'):?>
			<div id="more-info" class="tab-pane">
				<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							'nome',
							'lattes',
							'email',
							'telefone',
							'celular',
							'nome_mae',
							'RG',
							'orgao_expedidor',
							'CPF',
							'cartao_ufrgs',
							'data_nascimento',
							'endereco_residencial',
							'instituicao',
							'orgao_departamento',
							'info_adicional',
						
						),
					)); ?>
			</div>
			<?php endif;?>
		</div>
	</div>
</div>


