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

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<?php /*<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> */?>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />

   <!-- User Styles -->
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.less" rel="stylesheet/less">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/elements.less" rel="stylesheet/less">
  <?php /* <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.less" rel="stylesheet/less"> */ ?>
	

	<title><?php echo CHtml::encode("SIPESQ"); ?></title>
	<style>
		body{
			padding-top: 27px;
			width: 100%;
		}
		
		#grantt-page{
		
		background-color: white;
		margin-top: 10px;
		padding-top: 10px;
		width: 100%;
		
		}
		
		.fixed{

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

<div class="grantt-page" id="grantt-page">
	
<!--	header-->
	<div id="novo-menu" class=" navbar-fixed-top" style="max-width: 950px; margin:0 auto;">
	<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>Sipesq::mainMenu(),
    )); ?>
	</div>	

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by Equipe Cepik.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/less.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/bootstrap.min.js' ?>"></script>
</html>
