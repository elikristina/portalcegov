<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <title>CEGOV</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Centro de Estudos Internacionais Sobre Governo">
    <meta name="author" content="CEGOV">
	<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <?php $baseUrl = Yii::app()->request->baseUrl;?>
	
	<!-- Le styles -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet">
	    
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	
    <!-- Fav Icons -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" /> 
    <link rel="shortcut icon" type="image/x-icon"  href="img/favicon.ico" />
	
	
	<link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>/css/favicon.ico" /> 
	<link rel="shortcut icon" type="image/x-icon"  href="<?php echo $baseUrl; ?>/css/favicon.ico" />
	
	<!--  User styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/form.css" />
	<link type="text/css" href="<?php echo $baseUrl; ?>/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-40073358-1', 'ufrgs.br');
	  ga('send', 'pageview');
	
	</script>
	
	<script type="text/javascript">		
	  var _gaq = _gaq || [];
	  _gaq.push(['_setAccount', 'UA-40073358-1']);
	  _gaq.push(['_trackPageview']);
	
	  (function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	  })();
	</script>
	

</head>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="sidebar-curso">
        <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <ul class="nav nav-list">
          <li class="active" data-section="1"><i class="icon icon-home"></i><span>Home</span></li>
          <br />
          <li data-section="2"><i class="icon icon-user"></i><span>Notícia</span></li>
          <br />
          <li class="last" data-section="3"><i class="icon icon-envelope"></i><span>Contato</span></li>
        </ul>
      </div>
    
      <div class="content-curso">
        <?php echo $content; ?>
      </div>
    </div>
	</div><!-- /container -->

	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo $baseUrl;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseUrl;?>/js/less.js"></script>
    
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/browsers.js"></script>
	<script type="text/javascript">$('.tip').tooltip({placement: 'bottom'});</script>

<script>
$('.btn-navbar').click( function() {
      $('html').toggleClass('expanded');
    });
</script>
  

</body>
</html>
