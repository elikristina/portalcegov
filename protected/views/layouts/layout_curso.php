<!DOCTYPE HTML>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8">
    <title>CEGOV - Curso PPA</title>
    <meta name="description" content="Centro de Estudos Internacionais Sobre Governo">
    <meta name="author" content="CEGOV" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    
    <!--[if IE 7]>
      <link href="css/font-awesome-ie7.min.css" rel="stylesheet">
    <![endif]-->
  
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <?php $baseUrl = Yii::app()->request->baseUrl;?>

    <!-- Le styles -->
    <link href="<?php echo $baseUrl; ?>/css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="<?php echo $baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet" media="screen">
    <link href="<?php echo $baseUrl; ?>/css/main_curso.css" rel="stylesheet" media="screen">
    <link href="<?php echo $baseUrl; ?>/css/main_curso.css" rel="stylesheet">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

    <!-- Fav Icons -->
    <link rel="icon" type="image/x-icon" href="img/favicon.ico" /> 
    <link rel="shortcut icon" type="image/x-icon"  href="img/favicon.ico" />

    <link rel="icon" type="image/x-icon" href="<?php echo $baseUrl; ?>/css/favicon.ico" /> 
    <link rel="shortcut icon" type="image/x-icon"  href="<?php echo $baseUrl; ?>/css/favicon.ico" />

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
  

  </head>

  <body>
    <div id="wrapper">
      <div id="sidebar">
        <a class="btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <!-- <div id="logo"> <a href="/"><img src="img/logo.svg" alt="logo" /></a> </div> -->
        <nav id="nav" class="navigation" role="navigation">
          <ul class="unstyled">
            <li class="active" data-section="1"><i class="icon-home icon-large"></i> <span>Home</span></li>
            <li data-section="2" class=""><i class="icon-info-sign icon-large"></i> <span>Sobre</span></li>
            <li data-section="3" class=""><i class="icon-laptop icon-large"></i> <span>Aulas</span></li>
            <li data-section="4" class=""><i class="icon-rss icon-large"></i> <span>Notícias</span></li>
            <li data-section="5" class="last"><i class="icon-envelope icon-large"></i> <span>Contato</span></li>
          </ul>
        </nav><!-- /nav -->
      </div><!-- /sidebar -->
      
      <div id="container">
                    
        <section class="section" id="section1" data-section="1">
        
          <div class="container-fluid"> 
            <div class="row-fluid">
              
              <div class="span12 intro">
                <hgroup>
                  <h4>Curso de Capacitação EAD em </h4>
                  <h2>Planejamento Estratégico Municipal e Desenvolvimento Territorial</h2>
                </hgroup>
                <button class="btn-inverse" data-section="2">
                  Saiba <span>Mais</span>
                  <i class="icon-circle-arrow-down"></i>
                </button>
              </div><!-- /span6 -->
              
            </div><!-- /row-fluid -->
          </div><!-- /container-fluid --> 
        </section><!-- /section -->

          <div id="welcome">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                </div>
              </div>
            
            </div>
          </div>



        <section class="section" id="section2" data-section="2">
          <div class="container-fluid">
            <div class="row-fluid title">
              <div class="span4">
                <h2>Sobre</h2>
              </div><!-- /span4 -->
              <div class="span8 hidden-phone">  
                <hr>
              </div><!-- /span8 -->
            </div><!-- /row-fluid -->
            
            <div class="row-fluid desc">
              <div class="span8">
                <p>O Curso de Capacitação EAD em Planejamento Estratégico Municipal e Desenvolvimento Territorial é 
                   fruto de uma parceria entre o Ministério do Planejamento, Orçamento e Gestão do Governo Federal
                   e o Centro de Estudos Internacionais sobre Governo para a elaboração e criação de uma rede eletrônica 
                   de suporte a qualificação de gestores público locais na elaboração, implementação, monitoramentento e 
                   avaliação dos Planos Plurianuais (PPAs) nos municípios brasileiros, para o período 2013-2015.</p>
              </div><!-- /span8 -->
            </div><!-- /row-fluid -->
            
            <div class="row-fluid content">
              <div class="span12">
                <div class="row-fluid">
                  <div class="span3 service">
                    <?php echo CHtml::image(Yii::app()->baseUrl .'/images/logo_cegov.png', 'Logo', array('id'=>'logo-cegov'))?> 
                  </div>
                  <div class="span3 service">
                    <?php echo CHtml::image(Yii::app()->baseUrl .'/images/logo_ufrgs.png', 'Logo', array('id'=>'logo-ufrgs'))?> 
                  </div>
                  <div class="span3 service">
                    <?php echo CHtml::image(Yii::app()->baseUrl .'/images/logo_mpog.png', 'Logo', array('id'=>'logo-mpog'))?> 
                  </div>
                  <div class="span3 service">
                    <?php echo CHtml::image(Yii::app()->baseUrl .'/images/logo_brasil.png', 'Logo', array('id'=>'logo-brasil'))?> 
                  </div>
                  
                  
                </div><!-- /row-fluid --> 
              </div><!-- /span12 -->
            </div><!-- /row-fluid -->
          </div><!-- /container -->
        </section><!-- /section --> 
        
        
        
        <div id="welcome">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                </div>
              </div>
            
            </div>
        </div>


         <section class="section" id="section3" data-section="3">
        
          <div class="container-fluid"> 
            <div class="row-fluid">
              
              <div class="span12 intro">
                <hgroup>
                  <h2>Aulas via Moodle</h2>
                  <p>As aulas do Curso de Capacitação EAD em Planejamento Estratégico Municipal 
                     e Desenvolvimento Territorial são disponibilizadas através da plataforma Moodle.
                     O Moodle é um Ambiente Virtual de Aprendizagem amplamente utilizado pelas 
                     Universidades no Brasil para o ensino a distância.</p>
                </hgroup>
                <a href="https://moodleinstitucional.ufrgs.br" target="_blank" class="btn-inverse">Acesse aqui<i class="icon-circle-arrow-down"></i></a>
              </div><!-- /span6 -->
              
            </div><!-- /row-fluid -->
          </div><!-- /container-fluid --> 
        </section><!-- /section -->



        
        
        <div id="welcome">
            <div class="container-fluid">
              <div class="row-fluid">
                <div class="span12">
                </div>
              </div>            
            </div>
        </div>
        
        
        <section class="section" id="section4" data-section="4">
          <div class="container-fluid">
            <div class="row-fluid title">
              <div class="span4">
                <h2>Notícias</h2>
              </div><!-- /span4 -->
              <div class="span8 hidden-phone">  
                <hr>
              </div><!-- /span8 -->
            </div><!-- /row-fluid -->
            
            <div class="row-fluid content">
              <div class="span4">
                <ul class="article-tags">
                  <?php $news = Noticia::model()->findAll(array('order'=>'cod_noticia DESC, titulo', 'condition'=>'eh_cursoppa=true', 'limit'=>10))?>
                    <?php foreach($news as $new):?>
                      <li data-blog="blg-<?php echo $new->cod_noticia?>"><?php echo CHtml::encode($new->titulo);?></li>
                    <?php endforeach;?>
                </ul>
              </div><!-- /span4 -->
              
              <div class="span8 slide current" data-blog="main">
                <div class="row-fluid">
                  <div class="span12 expand">
                    <h5>Clique nas notícias ao lado para acessá-las</h5>
                  </div><!-- /span6 -->
                </div><!-- /row-fluid -->
              </div><!-- /span8 -->

              <?php foreach($news as $new):?>
              <div class="span8 slide" data-blog="blg-<?php echo $new->cod_noticia ?>" >
                <div class="row-fluid">
                  <div class="span12 expand">
                    <h4><?php echo $new->titulo ?></h4>
                    <p><?php echo $new->texto ?></p>
                  </div><!-- /span6 -->
                </div><!-- /row-fluid -->
              </div><!-- /span8 -->
              <?php endforeach;?><h4></h4>
                                      
            </div><!-- /row-fluid -->
          </div><!-- /container -->
        </section><!-- /section -->
        
        
        <section class="section" id="section5" data-section="5">
          <div class="container-fluid">
            <div class="row-fluid title">
              <div class="span4">
                <h2>Contato</h2>
              </div><!-- /span4 -->
              <div class="span8 hidden-phone alt">  
                <hr>
              </div><!-- /span8 -->
            </div><!-- /row-fluid -->
            <div class="row-fluid content">
              <div class="span4">
                <div class="row-fluid alt">
                  <h5>Email:</h5>
                  <span>cursoppa@cegov.ufrgs.br</span>
                </div><!-- /row -->
                <div class="row-fluid alt">
                  <h5>Telefone:</h5>
                  <span>(51) 3308-9860</span>
                </div><!-- /row -->
                <div class="row-fluid alt">
                  <h5>Site:</h5>
                  <span><a href="http://www.cegov.ufrgs.br" rel="external">www.cegov.ufrgs.br</a></span>
                </div><!-- /row -->
              </div><!-- /span4 -->
              
              <div class="span8">
              
                <div class="row-fluid">
                  <div class="span12">
                  </div><!-- /span12 -->
                </div><!-- /row-fluid -->
                
                


            </div><!-- /span8 --> 
            
            <div id="footer">
              <div class="row-fluid">
                <div class="span12">
                  
                </div><!-- /span12 -->
              </div><!-- /row-fluid --> 
            </div><!-- /footer -->
          </div><!-- /row-fluid --> 
        </div><!-- /container-fluid -->
        
      </div><!-- /container --> 
    </div><!-- /wrapper -->   
  
    <!-- JAVASCRIPTS -->
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/main_curso.js"></script>
  </body>
</html>
