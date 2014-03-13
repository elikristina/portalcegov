<?php /* @var $this Controller */ ?>

<!DOCTYPE html>
<html lang="pt">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>O que ta valendo?</title>


  <!-- Fav Icons -->
  <link rel="icon" type="image/x-icon" href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" /> 
  <link rel="shortcut icon" type="image/x-icon"  href="<?php echo Yii::app()->request->baseUrl; ?>/img/favicon.png" />

	<!-- BootStrap Twitter framework -->
	<link  href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap.css" rel="stylesheet" />
	<link  href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/bootstrap-responsive.css" rel="stylesheet"/>

	
	 <!-- User Styles -->
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/sipesq.less" rel="stylesheet/less">
  <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/elements.less" rel="stylesheet/less">

  <!-- Old Styles -->
  <link  href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap/sipesq.css" rel="stylesheet" />


	
	 <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
</head>

<body>

 <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>          
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link"><?php echo Yii::app()->user->name; ?></a>
            </p>
            <ul class="nav">            
            <?php $this->widget('application.extensions.mbmenu.MbMenu',array(
                'activeCssClass'=>'active',
                'activateItems'=>true,
                'activateParents'=>true,
                'encodeLabel'=>false,
                'activeCssClass'=>'active',
                'htmlOptions'=>array('class'=>'nav'),

                'items'=>array(
                    array('label'=>'Início', 'url'=>array('/site/index')),
                    array('label'=>'Gerencial', 'url'=>array('#'), 'itemOptions'=>array('id'=>'menuGerencial'),
                    'items'=>array(
                      array('label'=>'Agenda de Horários', 'url'=>array('/agenda')),
                       //Atividades
                      array('label'=>'Atividades', 'url'=>array('/atividade'), 
                        'items'=>array(
                        array('label'=>'Cadastrar Atividade', 'url'=>array('/atividade/create')),
                        array('label'=>'Gerenciar Atividades', 'url'=>array('/atividade')),
                        array('label'=>'Categorias de Atividades', 'url'=>array('/atividadeCategoria')),
                      ),), //Fim Atividades
                        array('label'=>'Pessoas', 'url'=>array('/pessoa'), 
                        'items'=>array(
                        array('label'=>'Equipe', 'url'=>array('/pessoa')),
                        array('label'=>'Equipe Atual', 'url'=>array('/pessoa/equipe')),
                        array('label'=>'Contatos', 'url'=>array('/contato')),
                        array('label'=>'Funções no Sistema', 'url'=>array('/funcoesPessoa')),
                        array('label'=>'Categorias de Pessoas', 'url'=>array('/pessoaCategoria')),
                          array('label'=>'Financeiro', 'url'=>array('/pessoaFinanceiro'),
                          'items'=>array(
                              array('label'=>'Bolsas e Pagamentos', 'url'=>array('/pessoaFinanceiro')),
                              array('label'=>'Pessoas com Recebimentos', 'url'=>array('/pessoa/bolsistas')),
                            array('label'=>'Categorias', 'url'=>array('/financeiroCategoria/admin'),'visible'=>(!Yii::app()->user->isGuest)),
                            array('label'=>'Fontes Pagadoras', 'url'=>array('/fontePagadora/admin'),'visible'=>(!Yii::app()->user->isGuest)),
                            array('label'=>'Instituiçoes', 'url'=>array('/vinculoInstitucional'),'visible'=>(!Yii::app()->user->isGuest)),
                            ),),),
                            
                    ), //fim pessoas
                    //Projetos
            array('label'=>'Projetos', 'url'=>array('/projeto'),
                          'items'=>array(
                              array('label'=>'Ativos', 'url'=>array('/projeto/ativos')),
                              array('label'=>'Encerrados', 'url'=>array('/projeto/finalizados')),)  
                    ), //fim projetos 
                   
                    ),), // fim gerencial
                    
                    array('label'=>'Acervo', 'url'=>array('#'), 'itemOptions'=>array('id'=>'menuAcervo'),
                    'items'=>array(
                       array('label'=>'Acervo Digital', 'url'=>array('/site/acervodigital'),
                          'items'=>array(
                              array('label'=>'Consolidado', 'url'=>array('/site/acervoDigital', 'f'=>"/acervo/acervo digital/consolidado/")),
                              array('label'=>'Renomear', 'url'=>array('/site/acervoDigital')),
                            ),
                          ),
                     array('label'=>'Acervo Físico', 'url'=>array('/livro'),
                          'items'=>array(
                              array('label'=>'Consolidado', 'url'=>array('/livro')),
                              array('label'=>'Cadastrar Item', 'url'=>array('/livro/create')),
                              array('label'=>'Empréstimos', 'url'=>array('/livro/emprestimos')),
                              array('label'=>'Histórico de Empréstimos', 'url'=>array('/livro/historico')),
                            ),
                          ),
                      array('label'=>'Biblioteca de Links', 'url'=>array('/links')),
                      array('label'=>'Produção Científica da Equipe', 'url'=>array('/site/acervoDigital')),
                      array('label'=>'Media Wiki', 'url'=>'http://143.54.64.104/mediawiki/', 'visible'=>!Yii::app()->user->isGuest),
                      array('label'=>'Patrimônios', 'url'=>array('/patrimonioTermo/index')),
                      array('label'=>'Subscriptions', 'url'=>array('/subscription')),
                      
                    ) //fim itens do acervo                
                    ), // fim acervo
                  
                   array('label'=>'Relatórios', 'url'=>array('/relatorio'),'itemOptions'=>array('id'=>'menuRelatorio'), ),
                    array('label'=>'SIPESQ', 'url'=>array('/site/sobre'), 
                      'items'=>array(
                      array('label'=>'Documentação', 'url'=>array('/site/acervoDigital', 'f'=>'/SIPESQ/')),
                      array('label'=>'Sobre o SIPESQ', 'url'=>array('site/sobre')),
                      array('label'=>'Passos', 'url'=>array('/passosConstrucao'), 'visible'=>!Yii::app()->user->isGuest),
                    )),
                    array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Minha Página', 'url'=>array('/pessoa/myself'), 'visible'=>!Yii::app()->user->isGuest),
            array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            
                ),
        )); ?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<hr><br>


<div class="container-fluid main-container">
	<?php echo $content; ?>

</div><!-- container -->

<footer>
        <p>&copy; Company 2012</p>
      </footer>

<!-- Javascript - No final para a pagina carregar mais rapido -->
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>	
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/less.js"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>

</body>
</html>
