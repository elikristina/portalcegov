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

	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.css" />

   <!-- User Styles -->
 <?php /* 
 
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/sipesq.less" rel="stylesheet/less">
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/menu.less" rel="stylesheet/less">
 <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/elements.less" rel="stylesheet/less">
 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" /> 
  
  */?>
</head>

<?php echo $content; ?>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
<!--<script type="text/javascript" src="https://www.dropbox.com/static/api/1/dropbox.js" id="dropboxjs" data-app-key="h5zoo356crk9wvp"></script>-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/formatter.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/less.js' ?>"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/bootstrap.min.js' ?>"></script>
</html>
