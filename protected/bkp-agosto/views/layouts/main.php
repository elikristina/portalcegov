<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<meta name="language" content="pt-br" />
	
	<?php $baseUrl = Yii::app()->request->baseUrl;?>
	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link type="text/css" href="<?php echo $baseUrl; ?>/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>
	
	<!-- blueprint CSS framework -->
	<link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>/css/favicon.ico" /> 
	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo $baseUrl; ?>/css/favicon.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/print.css" media="print" />
	
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/form.css" />
	
	<!-- Jquery-UI e Jquery 1.8 -->
	
	
	
	<title>CEGOV</title>
	<script type="text/javascript">
	function filebrowser(field_name, url, type, win) {
		
		fileBrowserURL = "http://localhost/cegov2/pdw/index.php?filter=" + type;
				
		tinyMCE.activeEditor.windowManager.open({
			title: "PDW File Browser",
			url: fileBrowserURL,
			width: 950,
			height: 650,
			inline: 0,
			maximizable: 1,
			close_previous: 0
		},{
			window : win,
			input : field_name
		});		
	}

</script>

</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo_cegov"><?php echo CHtml::link(CHtml::image($baseUrl .'/css/logo_cegov.jpg'), array('/site/index'));?></div>
		<div id="logo_ufrgs"><?php echo CHtml::link(CHtml::image($baseUrl .'/css/logo_ufrgs.jpg'), 'http://www.ufrgs.br/', array('target'=>'_blank')); ?></div>
	</div>
	
	<div id="novo_menu">
	<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
            'items'=>array(
				array('label'=>Yii::t('default', 'home'), 'url'=>array('/site/index')),
				array('label'=>Yii::t('default', 'sobre'), 'url'=>array('/about/index'),
				 'items' => array(
						array('label'=>Yii::t('default', 'apresentacao'), 'url'=>array('/about/presentation')),
						array('label'=>Yii::t('default', 'parceiros'), 'url'=>array('/about/partners')),
					)
				),
				array('label'=>Yii::t('default', 'gts'), 'url'=>array('/gt'), array('id'=>'gt')),
				array('label'=>Yii::t('default', 'equipe'), 'url'=>array('/pessoa/index'), array('id'=>'equipe')),
				//array('label'=>'Equipe', 'url'=>array('/pessoa/index'), 'items' => Pessoa::getArrayMenu()),
				array('label'=>Yii::t('default', 'publicacoes'), 'url'=>array('/publicacao')),
				array('label'=>'Atlas', 'url'=>array('/atlas'), 'visible'=>!Yii::app()->user->isGuest),			
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
			),
    ));  ?>
    
    <?php echo CHtml::form(); ?>
    <?php if(!Yii::app()->user->isGuest):?>
	    <div id="langdrop">
	        <?php echo CHtml::dropDownList('_lang', Yii::app()->language, array(
	            'en' => 'English', 'pt' => 'Português'), array('submit' => '')); ?>
	    </div>
    <?php endif;?>
	<?php echo CHtml::endForm(); ?>
    
	</div> <!-- Menu principal com submenu dropdown -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>
	
	<!-- Conteúdo principal -->
	<?php echo $content; ?>
			
	<div id="footer">
	<b><?php echo Yii::t('default', 'cegov');?></b><br/>
			Campus do Vale, prédio 43322 - Av. Bento Gonçalves, 9500<br/>
	Porto Alegre - RS, Brasil, CEP 91509-900<br/>
	
	Tel:<a href="tel:+555133089860">+55 51 3308-9860</a><br/><br/>
	
			<p align="right">
			<?php if(Yii::app()->user->isGuest):?>
				<?php echo CHtml::link("Login", array("site/login"));?>
			<?php else:?>
				<?php echo CHtml::link("Logout (" .Yii::app()->user->name .")", array("site/logout"));?>
			<?php endif;?>
			</p>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
