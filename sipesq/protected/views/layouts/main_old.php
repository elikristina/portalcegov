<!DOCTYPE html>
<html lang="pt">  
<head>
	<meta charset="utf-8">
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	 <!-- Fav Icons -->
  	<link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/css/icon.png" /> 
  	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo Yii::app()->request->baseUrl; ?>/css/icon.png" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/kanban.min.css" />
	
   <!-- User Styles -->
   
 <?php  
 /*
  * <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/kanban.less" rel="stylesheet/less">
  * 
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.less" rel="stylesheet/less">
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.less" rel="stylesheet/less">
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/elements.less" rel="stylesheet/less">
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> 
  
  */?>
  
	<title><?php echo CHtml::encode("SIPESQ"); ?></title>
	<style>
	body{
		padding-top: 27px;
	}
	</style>
	
</head>


<?php  if(isset($this->idMenu)):?>
<?php 
Yii::app()->clientScript->registerScript('menu-visit', "
$(document).ready(
	function(){
		id = ". $this->idMenu ."
	 	$(id).addClass('active');
	 	return false;
	 }
);
"); 
?>
<?php endif ?>


<body>

<div class="container" id="page">

<div id="header">
	<div align="center">
	<?php echo CHtml::image(Yii::app()->request->baseUrl ."/css/logocl.png",'logo' ,array('height'=>100, 'align'=>'center'))?>
	</div>
	<div id="logo"></div>
	</div>  
	
<!--	header-->
	<div id="novo-menu" class=" navbar-fixed-top" style="margin:0 auto;">
	<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>Sipesq::mainMenu(),
    )); ?>
    <?php //Tem mais a pesquisa que fica no MbMenu ?>
	</div>

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by CEGOV.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
<?php /* 
	<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="h5zoo356crk9wvp"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/less.js' ?>"></script>
*/ ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/formatter.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/bootstrap.min.js' ?>"></script>
<script>

$('#sq').change(function(){
	if($('#sq').val().trim().length > 2)
		window.location.href = '/sipesq/index.php/site/search/?q=' + $('#sq').val().trim();
});

</script>
</html>
