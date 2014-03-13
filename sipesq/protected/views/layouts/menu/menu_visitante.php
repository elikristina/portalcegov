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
              <li class="active"><a href="<?php echo $this->createUrl('/site/index')?>">SIPESQ</a></li>
            </ul>
            <form class="navbar-form pull-right form-inline" id="login-form" action="<?php echo $this->createUrl('/site/index')?>" method="POST">
                <label class="checkbox" class="active">
    			Mantenha-me conectado<input name="LoginForm[rememberMe]" id="LoginForm_rememberMe" value="1" type="checkbox"> 
  				</label>
              <input class="span2" type="text" name="LoginForm[username]" id="LoginForm_username" placeholder="Usuário">
              <input class="span2" type="password" placeholder="Senha" name="LoginForm[password]" id="LoginForm_password" >
              <button type="submit" class="btn">Entrar</button>
            </form>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>