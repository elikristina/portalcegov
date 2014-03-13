<?php
$this->breadcrumbs=array(
	'Projetos',
);

$this->menu=array(
	array('label'=>'Adicionar Projetos', 'url'=>array('create')),
	array('label'=>'Gerenciar Projetos', 'url'=>array('admin')),
);
?>
<?php $url = $this->createUrl("/projeto/view");?>
<script>
	function filtraProjeto()
	{	
		
		var url = '<?php echo $url?>';
    	var projeto = $('#dropDownProjeto').val();

    	console.log('filtando o projeto');
    	
    	if(projeto){
        	url += '/' + projeto;
        	location.href = url;
    	}
	}
	
</script>

<h1>Projetos</h1>
	<?php echo CHtml::dropDownList('dropDownProjeto','',CHtml::listData(Projeto::model()->findAll(array('order'=>'situacao, nome')), 'cod_projeto', 'nome', 'situacao_text'), array('prompt'=>"Selecione um projeto",'onchange'=>'filtraProjeto();', 'class'=>'input-xxlarge')); ?><br>
	
	<div class="tabbable tabs-left">
	<ul class="nav nav-tabs" id="tab-projetos">
	<?php foreach (Projeto::$momentos as $k=>$m):?>
		<li class="<?php echo ($k == $situacao) ? "active" : ""?>"><?php echo CHtml::link($m, array("/projeto/index",'situacao'=>$k))?></li>
	<?php endforeach;?>
	</ul>
	
	
	<div class="tab-content">
	  <div class="tab-pane active" id="info">
	  	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
	  </div>
	</div><!-- /tabbable tabs -->

</div>
