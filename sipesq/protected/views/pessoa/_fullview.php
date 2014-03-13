<?php
$this->breadcrumbs=array(
	'Pessoas'=>array('index'),
	$data->nome,
);

$this->menu=array(
	
	array('label'=>'Gerenciar Pessoas', 'url'=>array('admin'), 'visible'=>Sipesq::isAdmin()),
	array('label'=>'Editar Dados', 'url'=>array('update', 'id'=>$data->cod_pessoa)),
	array('label'=>'Restaurar Senha', 'url'=>array('restorePassword', 'id'=>$data->cod_pessoa), 'visible'=>(Sipesq::getPermition('pessoa.informacoes') >= 100)),
	array('label'=>'Trocar Senha', 'url'=>array('changePassword'), 'visible'=>(Yii::app()->user->getId() === $data->cod_pessoa)),
	array('label'=>'Deletar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$data->cod_pessoa),'confirm'=>'Tem certeza que deseja deletar esta pessoa?'), 'visible'=>(Sipesq::getPermition('pessoa.informacoes') >= 100)),
	array('label'=>'+ Pessoa', 'url'=>array('create'), 'visible'=>(Sipesq::getPermition('pessoa.informacoes') >= 1)),
	array('label'=>'+ Projeto Atuante', 'url'=>array('addprojetoatuante', 'id'=>$data->cod_pessoa)),
	
);
?>

<?php 
Yii::app()->clientScript->registerScript('tab-menu', "
$('.tip').tooltip();
");
?>

<?php 
			Yii::app()->clientScript->registerScript('financeiro', "
		
			$('.fin-detail-btn').toggle(
		
		function(){
				id = $(this).parent().parent('tr').attr('id');
				container = $('#fin-detail');
				$(this).val('-');
				
		
			$.get('/sipesq/index.php/pessoaFinanceiro/view/'	,
					
				{id: id, no_layout: 1},function (data){
						$(container).append(data );
						$(container).focus();
					},
					\"html\"); 
					
			return false;
					
		},
		
		function(){
				 $('#fin-detail').text('');
				 $('.fin-detail-btn').val('+');
				return false;
			}
		);"
		);
?>
<div class="row-fluid">
<div class="span12">

<h1 align="center"><?php echo $data->nome; ?></h1>

<ul class="nav nav-tabs">
      <li class="active"><a href="#info" data-toggle="tab">Informações Gerais</a></li>
      <li><a href="#projetos" data-toggle="tab">Projetos</a></li>
      <li><a href="#atividades" data-toggle="tab">Atividades</a></li>
      <?php if(Sipesq::isSupport() || ($data->cod_pessoa === Yii::app()->user->getId()) ):?>
      <li><a href="#financeiro" data-toggle="tab">Pagamentos</a></li>
      <?php endif;?>
</ul>



<div class="tab-content">
	<div class="tab-pane active" id="info">
		<?php 
			if(Sipesq::getPermition("pessoa.informacoes_avancadas") >= 2
				|| Yii::app()->user->getId() == $_GET['id'])
		 		$this->renderPartial('_info', array('data'=>$data));
			else 
				$this->renderPartial('_info_basica', array('data'=>$data));
		
		?>
	</div> <!-- Fim Tab Informações -->
	
	<div class="tab-pane" id="projetos">
		<?php $this->renderPartial('_projetos', array('data'=>$data))?>	
	</div> <!-- Fim tab  Projetos -->
	
	<div class="tab-pane" id="atividades">
		<?php $this->renderPartial('_atividades_json', array('data'=>$data))?>	
	</div> <!-- Fim tab  Atividades -->
	
	<div class="tab-pane" id="financeiro">
		<?php $this->renderPartial('_financeiro', array('data'=>$data))?>
	</div>
</div>


</div>
</div>


<!-- Modal -->
<div id="modal-info"  class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
  <div class="modal-body">
  <i class="icon icon-refresh"></i> Carregando...
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>

