<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/formatter.js' ?>"></script>
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

Yii::app()->clientScript->registerScript('tab-menu', "

		$('#lnkAtividades').click(
			function(){
				if($('#tabAtividades').attr('data-loaded') == '1')
					return;
		
				$('#tabAtividades').html('Carregando Atividades...');
		
				$('#tabAtividades').load('/sipesq/index.php/projeto/tabAtividades/' + cod_projeto, function(){
					$('#tabAtividades').attr('data-loaded', '1');
					$('.collapse').collapse();
					$('.accordion-heading').hover(
					function(){ $(this).css('background-color', '#DDD');}
					, function(){ $(this).css('background-color', '#FFF');}		
					);
				});

			}
		);	
		
");
?>

<h2><?php echo $model->nome; ?></h2>
<?php if(Sipesq::isSupport()):?>
	<?php echo CHtml::dropDownList('dropDownProjeto',$_GET['id']
			,CHtml::listData(Projeto::model()->findAll(array('order'=>'situacao, nome')),'cod_projeto', 'nome')
			, array('prompt'=>"Selecione um projeto",'onchange'=>'filtraProjeto();', 'class'=>'input-xxlarge')); ?><br>
<?php else:?>
	<?php echo CHtml::dropDownList('dropDownProjeto',$_GET['id']
			, CHtml::listData( Projeto::findAllOfUser() , 'cod_projeto', 'nome')
			, array('prompt'=>"Selecione um projeto",'onchange'=>'filtraProjeto();','class'=>'input-xxlarge')); ?><br>
<?php endif;?>
<div class="tabbable tabs-left">
<ul class="nav nav-tabs" id="myTab">
  <li <?php if(!$model->isSupport()):?>class="active"<?php endif;?>><a href="#info" data-toggle="tab">Informações</a></li>
  <?php if($model->isSupport()):?>
<!--   <li><a href="#financeiroOld" data-toggle="tab">Finaceiro Antigo</a></li> -->
  <li class="active"><a href="#financeiro" data-toggle="tab">Financeiro</a></li>
  <?php endif;?>
  <li><a href="#atividades" id="lnkAtividades" data-toggle="tab">Atividades</a></li>
  <li><a href="#documentos"  data-toggle="tab">Documentos</a></li>
  
</ul>


<div class="tab-content">
  <div class="tab-pane <?php echo $model->isSupport() ? "" : "active"?>" id="info">
  	<?php $this->renderPartial('_view_info', array('model'=>$model)); ?>
  </div>
  <div class="tab-pane <?php echo $model->isSupport() ? "active" : ""?>" id="financeiro">
  	<?php $this->renderPartial('_view_financeiro_new', array('model'=>$model)); ?>
  </div>
  <div class="tab-pane" id="financeiroOld">
  	<?php $this->renderPartial('_view_financeiro', array('model'=>$model)); ?>
  </div>
  <div class="tab-pane" id="atividades">
  	<a id="atividades"></a>
	<div id="tabAtividades" data-loaded="0"></div>
  </div>
  <div class="tab-pane" id="documentos">
  	<?php $this->renderPartial('_view_documentos', array('model'=>$model)); ?>
  </div>
</div>
</div>