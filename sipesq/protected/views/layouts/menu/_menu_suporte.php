<ul class="nav pull-right">
	<li class="dropdown pull-right"><a href="#" class="dropdown-toggle"
		data-toggle="dropdown"><i class="icon icon-cogs icon-white"></i> <b
			class="caret"></b> </a>
		<ul class="dropdown-menu">
			<li class="nav-header">Configurações do SIPESQ</li>
			<li><a href="<?php echo $this->createUrl('/grupo')?>">Grupos e Permissões</a></li>						
			<?php if(Sipesq::getPermition('gerencial.rubricas')):?>
			<li><a href="<?php echo $this->createUrl('/rubrica')?>">Rubricas</a></li>
			<?php endif ?>	

			<?php if(Sipesq::getPermition('gerencial.categoria_atividade')):?>
			<li><a href="<?php echo $this->createUrl('/atividadeCategoria')?>">Categorias
					de Atividades</a></li>
			<?php endif ?>
			<li class="divider"></li>
			
			<?php if(Sipesq::getPermition('gerencial.relatorios')):?>
			<li class="nav-header">Relatórios</li>
			<li><a href="<?php echo $this->createUrl('/relatorio/sipesq')?>">Relatório
					SIPESQ</a></li>
			<li><a href="<?php echo $this->createUrl('/relatorio/projeto')?>">Relatório
					de Projetos</a></li>
			<li><a href="<?php echo $this->createUrl('/relatorio/atividade')?>">Relatório
					de Atividades</a></li>
			<!--<li><a href="<?php echo $this->createUrl('/relatorio/pessoa')?>">Relatório
					de Pessoas</a></li>-->			
			<?php endif ?>
			<li class="nav-header"><?php echo Yii::app()->user->name; ?></li>
			<li><a href="<?php echo $this->createUrl('/pessoa/myself')?>"><i class="icon icon-user"></i> Perfil</a></li>
			<li><a href="<?php echo $this->createUrl('/site/logout')?>"><i class="icon icon-ban-circle"></i> Sair</a></li>			

		</ul>
	</li>
</ul>
