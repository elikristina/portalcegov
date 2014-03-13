<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="pt-BR" />
	<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAwtW6REnoXPwabzosDJ1ZbxSf6zeDUL0NX_-81yZ_3MTVk-1i4xQ4nST236nGieybG_Uiv9EE12qxDg"></script>
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl .'/js/formatter.js' ?>"></script>

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	

	<title><?php echo CHtml::encode("SIPESQ"); ?></title>
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
	<div id="logo"></div>
	</div><!-- header -->
	
	<div id="novo-menu">
	<?php $this->widget('application.extensions.mbmenu.MbMenu',array(
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
</html>
