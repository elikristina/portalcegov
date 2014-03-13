<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <div class="nav-collapse collapse main-menu">
            <ul class="nav">
              <li class="<?php echo ($this->activeMenu=='SIPESQ') ? 'active' : ''?>">
              	<a href="<?php echo $this->createUrl('/site/index')?>">SIPESQ</a>
              </li>
              <li class="<?php echo ($this->activeMenu=='Projetos') ? 'active' : ''?>">
              	<a href="<?php echo $this->createUrl('/projeto')?>">Projetos</a>
              </li>
              <li class="<?php echo ($this->activeMenu=='Pessoas') ? 'active' : ''?>">
              	<a href="<?php echo $this->createUrl('/pessoa')?>">Pessoas</a>
              </li>
              <li class="<?php echo ($this->activeMenu=='Atividades') ? 'active' : ''?>">
              	<a href="<?php echo $this->createUrl('/atividade')?>">Atividades</a>
              </li>
              
              <li class="dropdown <?php echo ($this->activeMenu=='Acervo') ? 'active' : ''?>" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acervo <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo $this->createUrl('/agenda')?>"><i class="icon icon-calendar"></i> Agenda</a></li>
                  <li><a href="<?php echo $this->createUrl('/livro')?>"><i class="icon icon-book"></i> Livros</a></li>
                  <li><a href="<?php echo $this->createUrl('/contato')?>"><i class="icon icon-envelope"></i> Contatos</a></li>
                  <li><a href="http://143.54.129.45/mediawiki" target="_blank"><i class="icon icon-file"></i> Media Wiki</a></li>
                  <li><a href="<?php echo $this->createUrl('/subscription')?>"><i class="icon icon-pencil"></i> Subscriptions</a></li>                  
                </ul>
              </li>
              <?php $this->renderPartial('/layouts/menu/_notificacoes');?>

            </ul>
            <?php $this->renderPartial('/layouts/menu/_menu_suporte');?>
            <?php $this->renderPartial("/layouts/menu/_search_form")?>
            <?php if(count($this->menu) > 0) $this->renderPartial('/layouts/menu/_menu_acoes');?>
          </div><!--/.nav-collapse -->
        </div><!-- /container -->
      </div>
</div>



