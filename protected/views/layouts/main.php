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
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900' rel='stylesheet' type='text/css'>
    <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/main.css" rel="stylesheet">
	    
	<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
	
    <!-- Fav Icons -->	
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

  <div id="header">
    <div id="content" class="row-fluid hidden-phone">
      <div id="logo" class="pull-left">
        <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/img/logo_cegov.png', 'Logo CEGOV'), array('/')); ?>
        <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/img/logo_ufrgsB.png', 'Logo UFRGS'), 'http://www.ufrgs.br'); ?>
      </div>
      <div id="icons" class="pull-right">
        <?php if(Yii::app()->language == 'pt'):?>
          <?php echo CHtml::link('English', array('/site/us'), array('title'=>'Turn to English', 'class'=>"lang tip"))?>
        <?php else:?>
          <?php echo CHtml::link('Português', array('/site/br'), array('title'=>'Mudar para Português', 'class'=>"lang tip"))?>
        <?php endif;?>
      <br/><br/><br/><br/><br/><br/>
      <a href="https://www.facebook.com/cegov"><i class="icon-facebook-sign icon-2x"></i></a>     
      <a href="http://www.youtube.com/channel/UC0sWCtr8H4brbIF5YZ3cqZw"><i class="icon-youtube-sign icon-2x"></i></a><br/>
          
      </div>
    </div><!--/content-->            
  </div><!--/header-->
  
   
  <div class="navbar">
    <div class="navbar-inner">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="hidden-desktop">
            <?php echo CHtml::link('CEGOV', array('/site/index'), array('class'=>'brand'));?>
          </div>
          <div id="barra" class="nav-collapse collapse">
          		<ul class="nav pull-right">
          	    <?php if(Yii::app()->user->isGuest):?>
              		<li class="pull-right"><?php echo CHtml::link('<i class="icon-user"></i> Login' , array('/site/login', 'returnUrl'=>$this->createUrl($this->route)));?></li>
              	<?php else:?>
              	<li class="dropdown" id="op-menu">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-wrench"></i> <b>Menu</b> <b class="caret"></b></a>
                <?php $this->menu[] = array(
                    		'label'=>'<i class="icon-user"></i> Logout ('.Yii::app()->user->name.')',
                    		'url'=>array('/site/logout')
                    	);?>
                    <?php if(count($this->menu) > 0):?>
					  	<?php	  
						$this->widget('zii.widgets.CMenu', array(
							'items'=>$this->menu,
							'encodeLabel'=>false,
							'activeCssClass'=>'active',
							'htmlOptions'=>array('class'=>'dropdown-menu'),
						));
						?>
					<?php endif; //Se o menu tem algum item?> 
                    <?php /*
                    <li><?php echo CHtml::link('<i class="icon-user"></i> Logout ('.Yii::app()->user->name.')' , array('/site/logout'));?></li>
                  */?>
              </li>
              	<?php endif;?>
              </ul>
              
             <?php $this->widget('zii.widgets.CMenu', array(
             				'activeCssClass'=>'active',
             				'activateItems'=>true,
             				'activateParents'=>true,
							'encodeLabel'=>false,
							'activeCssClass'=>'active',
							'htmlOptions'=>array('class'=>'nav'),
             				'items'=>array(
             				array('label'=>'<i class="icon-home icon-large"></i>', 'url'=>array('/site/index')),
                    array('label'=>Yii::t('default', 'sobre') .'&nbsp&nbsp<i class="icon-angle-down"></i>', 'url'=>array(''), 'linkOptions'=> array(
                            'class' => 'dropdown-toggle', 'data-toggle' => 'dropdown'), 'itemOptions' => array('class'=>'dropdown user'), 'items'=>array(
                      array('label'=>Yii::t('default', 'apresentacao'), 'url'=>array('/about/presentation')),
                      array('label'=>Yii::t('default', 'estrutura'), 'url'=>array('/about/structure')),
                      array('label'=>Yii::t('default', 'gts'), 'url'=>array('/gt/index')),
                      array('label'=>Yii::t('default', 'equipe'), 'url'=>array('/pessoa/index')),
                      array('label'=>Yii::t('default', 'parceiros'), 'url'=>array('/about/partners')),
                      )),
             				//array('label'=>Yii::t('default', 'gts'), 'url'=>array('/gt/index')),
             				//array('label'=>Yii::t('default', 'equipe'), 'url'=>array('/pessoa/index')),
             				array('label'=>Yii::t('default', 'projetos'), 'url'=>array('/projeto/index')),
             				array('label'=>Yii::t('default', 'noticias'), 'url'=>array('/new')),
             				array('label'=>Yii::t('default', 'eventos'), 'url'=>array('/new/events')),
             				array('label'=>Yii::t('default', 'publicacoes'), 'url'=>array('/publicacao/index')),
             				array('label'=>Yii::t('default', 'ferramentas'), 'url'=>array('/ferramenta')),
                    //array('label'=>Yii::t('default', 'Contato'), 'url'=>array('/about/partners')),
             
             				),
                'encodeLabel' => false,
                'htmlOptions' => array(
                    'class'=>'nav',
                        ),
                'submenuHtmlOptions' => array(
                    'class' => 'dropdown-menu',
                )
						));?>
          </div><!--/.nav-collapse -->
             
      
      </div>
    </div>

  <div id="main"> 
    <div id="bread">
      <?php if(isset($this->breadcrumbs)):?>      	
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
      <?php endif?>
    </div>	
    <?php echo $content; ?>
  </div> <!--/main-->



<!-- ConteÃºdo principal --><!--
  <div class="bread" style="background-color: #135">
    <?php if(strtotime(date('Y-m-d H:i')) >= strtotime('2013-04-22 09:20:00')):?>
      <h3 align="center"><a target="_blank" href="http://webconf.ufrgs.br/ivseminariocegov" class="">IV Seminário do CEGOV - SIGA AO VIVO!</a></h3>
    <?php else:?>
      <h3 align="center">IV Seminário do CEGOV será transmitido ao vivo. Aguarde!</h3>
    <?php endif;?>
  </div >-->
			

<footer>
  <div class="row-fluid">
    <div id="base">		  
      <div class="span8">
	      <h4><?php echo Yii::t('default', "cegov")?></h4>
	      <?php echo Yii::t('default', "endereco")?><br/>
	      <?php echo Yii::t('default', "cidade")?><br/>
	      <p>Tel:<a href="tel:+555133089860">+55 51 3308-9860</a></p><br/>
		  </div>		  
      <div class="span4 visible-desktop">
        <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl .'/images/logo_ufrgsB.png', 'Logo UFRGS'), 'http://www.ufrgs.br')?>
      </div>		
    </div>
	</div> <!-- /fluid -->
</footer>


	 <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="<?php echo $baseUrl;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $baseUrl;?>/js/less.js"></script>
    
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/browsers.js"></script>
	<script type="text/javascript">$('.tip').tooltip({placement: 'bottom'});</script>
</body>
</html>
