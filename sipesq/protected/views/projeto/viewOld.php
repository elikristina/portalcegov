<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<?php $url = $this->createUrl("/projeto/view");?>
<script>
	var cod_projeto = <?php echo $model->cod_projeto ?>;
	function filtraProjeto()
	{	
		var url = '<?php echo $url?>';
    	var projeto = $('#dropDownProjeto').val();
    	if(projeto){
        	url += '/' + projeto;
        	location.href = url;
    	}
	}
</script>

<?php
$this->breadcrumbs=array(
	'Projetos'=>array('index'),
	$model->nome,
);

$this->menu=$model->viewMenu();
?>


<?php 
$page = "info";
if(isset($_GET['p'])){
	$page = $_GET['p']; 
}

Yii::app()->clientScript->registerScript('tab-menu', "

		$('document').ready(
			function(){
			var secao = '#{$page}';
				$('.tab').hide();
				$(secao).parent().show('fast');
				$('#menu-tab a').removeClass('selected'); 
				return false;
			}
		);

		$('#menu-tab a').click(
			function(){
			 $('.tab').hide();
			 $($(this).attr('name')).parent().show('fast');
			 $('#menu-tab a').removeClass('selected'); 
			 $(this).addClass('selected');
			 return false;
			});
			
		$('#menu-tab a').hover(
			function(){
			 $(this).addClass('hover');
			 return false;
			}, 
			function(){
			 $(this).removeClass('hover');
			 return false;
			}
			);

		$('#lnkAtividades').click(
			function(){
				$('#tabAtividades').html('Carregando Atividades...');
				$('#tabAtividades').load('/sipesq/index.php/projeto/tabAtividades/' + cod_projeto);

			}
		);	
		
");
?>

<h1><?php echo $model->nome; ?></h1>
<?php if(Sipesq::isSupport()):?>
	<?php echo CHtml::dropDownList('dropDownProjeto',$_GET['id']
			,CHtml::listData(Projeto::model()->findAll(array('order'=>'nome')),'cod_projeto', 'nome')
			, array('prompt'=>"Selecione um projeto",'onchange'=>'filtraProjeto();', 'class'=>'input-xxlarge')); ?><br>
<?php else:?>
	<?php echo CHtml::dropDownList('dropDownProjeto',$_GET['id']
			, CHtml::listData( Projeto::findAllOfUser() , 'cod_projeto', 'nome')
			, array('prompt'=>"Selecione um projeto",'onchange'=>'filtraProjeto();','class'=>'input-xxlarge')); ?><br>
<?php endif;?>
<ul id="menu-tab">
      <li><a name="#info" id="lnkInfo" href="#">Informações Gerais</a></li>
      <?php if($model->isSupport(Yii::app()->user->getId())):?>
      	<li><a name="#financeiroOld" id="lnkFinanceiroOld" href="#">Financeiro Antigo</a></li> 
      	<li><a name="#financeiro" id="lnkFinanceiro" href="#">Financeiro</a></li>
      <?php endif;?>
      <li><a name="#atividades" id="lnkAtividades" href="#">Atividades</a></li>
      <li><a name="#documentos" id="lnkDocumentos" href="#">Documentos</a></li>
</ul>
<div class="tab">
	<a id="info"></a>
	<div id="tabInfo">
		<?php $this->renderPartial('_view_info', array('model'=>$model)); ?>
	</div>
</div><!--  fim tab info -->

<?php if($model->isSupport(Yii::app()->user->getId())):?>

	<div class="tab">
		<a id="financeiro"></a>
		<div id="tabFinanceiro">
			<?php $this->renderPartial('_view_financeiro_new', array('model'=>$model)); ?>
		</div>
	</div> <!-- Fim tab financeiro -->
	
	<div class="tab">
		<a id="financeiroOld"></a>
		<div id="tabFinanceiroOld">
			<?php $this->renderPartial('_view_financeiro', array('model'=>$model)); ?>
		</div>
	</div> <!-- Fim tab financeiro antigo -->
	
<?php endif;?>

<div class="tab">
	<a id="atividades"></a>
	<div id="tabAtividades"></div>
</div> <!-- Fim tab atividades -->


<div class="tab">
	<a id="documentos"></a>
	<div id="tabDocumentos">
	<h2>Documentos</h2>
	<table id="tbl-documentos" class="table">
		<tr><th>Nome</th><th>Data</th><th>Link</th><th>Ações</th></tr>
			
	<?php foreach($model->documentos as $doc):?>
			<tr class="tbl-line-documento" id="doc<?php echo $doc->cod_arquivo?>" data-descricao="<?php echo $doc->descricao; ?>">
				<td><?php echo CHtml::encode($doc->nome); ?></td>
				<td><?php echo CHtml::encode(date("d/m/Y", strtotime($doc->data_inclusao))); ?></td>
				<td>
					<?php echo CHtml::link("<i class='icon icon-download'></i>", $doc->href, array('target'=>'_blank'))?>					
				</td>
				<td>
					<?php echo CHtml::link("<i class='icon icon-edit'></i>", array('/projeto/updateFile', 'id'=>$doc->cod_arquivo))?>
					<?php echo CHtml::link("<i class='icon icon-trash'></i>",'',array('submit'=>array('deleteFile','id'=>$doc->cod_arquivo),'confirm'=>'Tem certeza que deseja excluir este arquivo?'))?>
				</td>
			</tr>
		
	<?php endforeach;?>
	</table>
	<?php echo CHtml::link('<i class="icon icon-file icon-white"></i> Incluir Documento' , array('/projeto/createFile', 'id'=>$model->cod_projeto), array('class'=>'btn btn-small btn-primary', 'style'=>'text-decoration: none'))?>
	
	<?php Yii::app()->clientScript->registerScript('documentos', "
	
		$('.icon-download').tooltip({title: 'Baixar Arquivo'});
		$('.icon-edit').tooltip({title: 'Editar'});
		$('.icon-trash').tooltip({title: 'Excluir'});
		
		var docs = $('.tbl-line-documento');
		for(i=0; i<docs.length; i++){
			$(docs[i]).popover({
		
                content: $(docs[i]).attr('data-descricao'),
                trigger: 'hover',
                placement: 'bottom',
                html: true
		})
		}
		
		$('.tbl-line-documento').hover(function(){
			$(this).css('background-color', '#CCC');
		}, function(){
			$(this).css('background-color', '#fff');
		});
	");?>
	</div>
</div> <!-- Fim tab atividades -->

