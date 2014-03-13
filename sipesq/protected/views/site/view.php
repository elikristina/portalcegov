<?php $this->pageTitle=Yii::app()->name; ?>

<?php $url = $this->createUrl("/site/view");?>
<script>
	function filtraPessoa()
	{	
		var url = '<?php echo $url?>';
    	var pessoa = $('#dropDownPessoa').val();
    	if(pessoa){
        	url += '/' + pessoa;
        	location.href = url;
    	}
	}
</script>

<?php 
//Registra os scripts para o scroll
$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.jscrollpane.min.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/jquery.mousewheel.js");
Yii::app()->clientScript->registerScriptFile($baseUrl ."/jScrollPane/mwheelIntent.js");
Yii::app()->clientScript->registerCssFile($baseUrl ."/jScrollPane/jquery.jscrollpane.css");

Yii::app()->clientScript->registerScript("scroll", "
	$(function()
	{
		$('.view-scroll').jScrollPane();
	});
");
?>

<h1><i>Sistema de Apoio ao Pesquisador</i></h1>
<?php if(Yii::app()->user->isGuest):?>
	<div class="view">
	
	<?php 
		$model=new LoginForm;
		$this->renderPartial("_login", array('model'=>$model)); 
	?>
	</div>
<?php endif;?>

<?php if(!Yii::app()->user->isGuest):?>
	
	<b>Pessoa</b><br>
	<?php echo CHtml::dropDownList('dropDownPessoa',$user,CHtml::listData(Pessoa::model()->findAll(array('order'=>'nome')), 'cod_pessoa', 'nome'), array('prompt'=>"Selecione uma Pessoa",'onchange'=>'filtraPessoa();',));?><br>

	<div id="atividades">
		<?php  $this->renderPartial("_atividades", array('user'=>$user)); ?>
	</div>
	
	<div id="pendencias">
		<?php  $this->renderPartial("_pendencias", array('user'=>$user)); ?>
	</div>
<?php endif;?>

<div id="agenda-bolsistass">
	<h4><b>Horário dos Bolsistas</b></h4>
	<?php  $this->renderPartial("/agenda/_agenda"); ?>
</div>


<div class="agenda-cepik">
<h4><b>Agenda Cepik</b></h4>
	<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;showTz=0&amp;mode=AGENDA&amp;height=455&amp;wkst=2&amp;bgcolor=%23ffffff&amp;src=gerenciacepik%40gmail.com&ctz=America/Sao_Paulo" style="border: 0" width="100%" height="300" frameborder="0" scrolling="no"></iframe>
</div>



	
