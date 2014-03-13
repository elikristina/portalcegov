<?php
$this->breadcrumbs=array(
	'Equipe'=>array('index'),
	$model->nome,
);

$this->menu=array(
	array('label'=>'Adicionar Pessoa', 'url'=>array('create')),
	array('label'=>'Editar', 'url'=>array('update', 'id'=>$model->cod_pessoa)),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cod_pessoa),'confirm'=>'Tem certeza que deseja deletar ' .$model->nome .'?')),
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin')),
);


Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . "/js/jquery-ui.js");
Yii::app()->clientScript->registerScript('accordion',"

//tabs
$('#tabs').tabs();
$('#tabs').tabs('option', 'fx', { opacity: 'toggle' });


");
?>

<!--<h1><?php //echo $model->nome; ?></h1>-->

<div class="view">
	<?php echo CHtml::image($model->imageLink, 'Imagem pessoal', array('height'=>100, 'width'=>100)); ?>
	<div style="float: right;">
	<h1><?php echo $model->nome;?></h1>
	<?php 
	for($i = 0; $i < count($model->categorias); $i++)
		if($i < 3)
			$categorias[] = $model->categorias[$i]->nome;
	?>
	<h4><i><?php echo implode(', ', $categorias)?></i></h4>
	<?php if(!Yii::app()->user->isGuest):?>
		<h4><i><?php echo CHtml::mailto($model->email,$model->email, array('target'=>'_blank'));?></i></h4>
	<?php endif;?>
	</div>
	
</div>

<div id="tabs">
			<ul>
				<li><a href="#intro">Apresentação</a></li>
				<li><a href="#pubs">Publicações</a></li>
				<li><a href="#gts">Grupos de Trabalho</a></li>
				<?php if(!Yii::app()->user->isGuest):?>
				<li><a href="#more-info">Informações Privadas</a></li>
				<?php endif;?>
			</ul>
			<div id="intro" class="pessoa-tab">
				<?php echo $model->descricao;?>
				<?php if(!Yii::app()->user->isGuest): //Link para edição da introdução?>
					<div class="row">
					<?php echo CHtml::link("Editar Apresentação",array("/pessoa/updateApp", 'id'=>$model->cod_pessoa),array('class'=>"button",));?>
					</div>
				<?php endif;?>
			</div>
			<div id="pubs" class="pessoa-tab">
				<p><?php //echo $model->pesquisa;?></p>
				
				<!-- Publicações pelo CEGOV -->
				<?php if(count($model->publicacoes_cegov) > 0):?>
					<h4>Publicações pelo CEGOV</h4>
					
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
					<h4>Publicações Pessoais</h4>
					
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
			<div id="gts" class="pessoa-tab">
				<?php if(count($model->grupos) > 0):?>
					<br>
					<h4>Grupos de Trabalho</h4>
						<?php foreach($model->grupos as $grupo):?>
							<div class="pub-list">
							<?php echo CHtml::link(CHtml::encode($grupo->nome), array('/gt/view', 'id'=>$grupo->cod_gt));?>
							</div>
						<?php endforeach;?>
				<?php else:?>
					<p> Não há Grupos de Trabalho cadastrados.</p>
				<?php endif;?>
			</div>
			<?php if(!Yii::app()->user->isGuest):?>
			<div id="more-info" class="pessoa-tab">
				<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							'nome',
							'lattes',
							'email',
							'nome_mae',
							'RG',
							'orgao_expedidor',
							'CPF',
							'cartao_ufrgs',
							'data_nascimento',
							'nacionalidade',
							'endereco_profissional',
							'instituicao',
							'orgao_departamento',
							'pagina_pessoal',
						
						),
					)); ?>
			</div>
			<?php endif;?>
		</div>
