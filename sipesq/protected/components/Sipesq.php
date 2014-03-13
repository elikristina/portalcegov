<?php
class Sipesq
{
	//Permissões do Sistemas
	const DENIED_PERMITION = -1;
	const USER_PERMITION = 0;
	const SUPPORT_PERMITION = 1;
	const READ_WRITE_PERMITION = 2;
	const ADMIN_PERMITION = 100;
	
	/**
	 * 
	 * Faz log de uma ação do usuário
	 * @param string $message
	 */
	public static function log($message){
		$log = new Log();
		$log->cod_pessoa = Yii::app()->user->getId();
		$log->mensagem = $message;
		$log->save();
	}
	
	/**
	 * Verifica se o usuário logado ou o usuário passado como parametro é admin do sistema
	 * @param integer $id
	 * 
	 */
	public static function isAdmin($id=null){
		if($id == null)	
			$id = Yii::app()->user->getId();
		if(Pessoa::getAccessLevel($id) == self::ADMIN_PERMITION)
			return true; //é admin
		else		
			return false; //não é admin
	}
	
	
	/**
	 * Verifica se o usuário logado ou o usuário passado como parametro é do suporte do sistema
	 * @param integer $id
	 */
	public static function isSupport($id=null){
		if($id == null)	
			$id = Yii::app()->user->getId();
		if(Pessoa::getAccessLevel($id) >= self::SUPPORT_PERMITION)
			return true; //é admin ou do suporte
		else		
			return false; //não é do suporte
	}
	

	public static function getPermition($route, $id=null){
		
		if (Yii::app()->user->isGuest) return 0;
		//verify the user
		if ( $id == null ) $id = Yii::app()->user->getId();
		
		$user = Pessoa::model()->with('grupos')->findByPk($id, array('select'=>'cod_pessoa, nome'));
		$routes = split('\.', $route);
		
		//permissao global para a rota
		//Algoritmo tem que pegar a maior permissao possível
		$permissao = 0;
		
		foreach($user->grupos as $grupo){
			$perm_grupo = json_decode($grupo->permissao);
			
			foreach($routes as $r){				
				if(property_exists($perm_grupo, $r))
					$perm_grupo = $perm_grupo->$r;
				else 
				 return -1; //Rota inexistente
			}
			if($perm_grupo > $permissao) 
				$permissao = $perm_grupo;
		}

		return $permissao;
	}
	
	
	/**
	 * 
	 * Retorna um array associativo com os valores => nomes das permissões do sistema.
	 * @return array() 
	 */
	public static function listPermitionData(){
		return array(
		//self::DENIED_PERMITION => 'Permissão Negada',
		self::USER_PERMITION => 'Usuário',
		self::SUPPORT_PERMITION => 'Apoio Técnico',
		self::ADMIN_PERMITION => 'Responsável',
		);
	}
	
	/**
	 * 
	 * Retorna um menu de testes
	 */
	public static function testMenu(){
	if(Yii::app()->user->isGuest){
		          return array(
			                array('label'=>'Início', 'url'=>array('/site/index')),
			                array('label'=>'SIPESQ', 'url'=>array('/site/index')),
			                array('label'=>'Cadastre-se', 'url'=>array('/pessoa/create')), 
			                array('label'=>'Login', 'url'=>array('/site/login')),
			            );
	         }
	}
	
	/**
	 * 
	 * Retorna um array associativo com os menus da página principal. 
	 * Este menu muda de acordo com o nível de acesso do usuário.
	 * @return array()
	 */
	public static function mainMenu(){
			
			//Retorna menu limitado a visitantes
			if(Yii::app()->user->isGuest){
		          return array(
			                array('label'=>'SIPESQ', 'url'=>array('/site/index')),
			                array('label'=>'Cadastre-se', 'url'=>array('/pessoa/create')), 
			                array('label'=>'Login', 'url'=>array('/site/login')),
			            );
	         }
		
		
		//Retorna menu completo
		if(Sipesq::isSupport()){
			return array(
	                  array('label'=>'SIPESQ', 'url'=>array('/site/index'), 
	                  'items'=>array(
	                	array('label'=>'Documentação', 'url'=>array('/site/acervoDigital', 'f'=>'/SIPESQ/')),
	                	array('label'=>'Sobre o SIPESQ', 'url'=>array('site/index')),
	                	array('label'=>'Passos', 'url'=>array('/passosConstrucao'), 'visible'=>!Yii::app()->user->isGuest),
	                )),
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
			                     	//array('label'=>'Consolidado', 'url'=>array('/site/acervoDigital', 'f'=>"/acervo/acervo digital/consolidado/")),
			                     	//array('label'=>'Renomear', 'url'=>array('/site/acervoDigital')),
			                  		array('label'=>'Search Server', 'url'=>'http://143.54.64.175','itemOptions'=>array('target'=>'_blank')),
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
	                	array('label'=>'Patrimônios', 'url'=>array('/patrimonioTermo/index')),
	                	array('label'=>'Subscriptions', 'url'=>array('/subscription')),
	                	
	                ) //fim itens do acervo                
	                ), // fim acervo
	              
	               array('label'=>'Relatórios', 'url'=>array('/relatorio'),'itemOptions'=>array('id'=>'menuRelatorio'), ),
	               array('label'=>'Media Wiki', 'url'=>array('/site/mediawiki'), 'visible'=>!Yii::app()->user->isGuest),
	                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
	                array('label'=>'Minha Página', 'url'=>array('/pessoa/myself'), 'visible'=>!Yii::app()->user->isGuest),
					array('label'=>'Logout ('.Yii::app()->user->name .' )', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
					
	            ); //fim menu completo
		}
	            
		
		//retorna menu simples
	            if(!Yii::app()->user->isGuest){
		          return array(
			                  array('label'=>'SIPESQ', 'url'=>array('/site/index'), 
			                  'items'=>array(
			                	array('label'=>'Sobre o SIPESQ', 'url'=>array('site/index')),
			                )),
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
			                		array('label'=>'Contatos', 'url'=>array('/contato')),),
					                		
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
			                						//array('label'=>'Consolidado', 'url'=>array('/site/acervoDigital', 'f'=>"/acervo/acervo digital/consolidado/")),
			                						//array('label'=>'Renomear', 'url'=>array('/site/acervoDigital')),
			                						array('label'=>'Search Server', 'url'=>'http://143.54.64.175','itemOptions'=>array('target'=>'_blank')),
			                				),
			                		),
					             array('label'=>'Acervo Físico', 'url'=>array('/livro'),
					                  'items'=>array(
					                     	array('label'=>'Consolidado', 'url'=>array('/livro')),
					                     	array('label'=>'Cadastrar Item', 'url'=>array('/livro/create')),
					                		),
					                	),
			                	
			                ) //fim itens do acervo                
			                ), // fim acervo
			              	array('label'=>'Media Wiki', 'url'=>array('/site/mediawiki'), 'visible'=>!Yii::app()->user->isGuest),
			                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
			                array('label'=>'Minha Página', 'url'=>array('/pessoa/myself'), 'visible'=>!Yii::app()->user->isGuest),
							array('label'=>'Logout ('.Yii::app()->user->name .' )', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
							
			            );
	            }
	            
	            
	}//fim public static mainMenu
	
	/**
	 * 
	 * Transforma uma data yyyy-mm-dd para dd/mm/yyyy
	 * @param string $date
	 * @return string 
	 */
	public static function date($date){
		
		$temp = explode('-', $date);
		if(count($temp) >= 3)
			return $temp[2] .'/' .$temp[1] .'/' .$temp[0];
		else return $date;
	}
	
	
	/**
	 * 
	 * Transforma uma data yyyy-mm-dd para dd/mm/yyyy
	 * @param string $date
	 * @return string 
	 */
	public static function dateRfc($date){
		
		$temp = explode('/', $date);
		if(count($temp) >= 3)
			return $temp[2] .'-' .$temp[1] .'-' .$temp[0];
		else return $date;
	}
	
	/**
	 * Compara 2 datas e retorna a diferença de meses entre elas
	 * @param string $date1 - Data no formado yyyy-m-d
	 * @param string $date2 - Data no formado yyyy-m-d
	 * @return number - Numero de meses entre uma data e outra
	 */
	public static function difMeses($date1, $date2=null){
	
		$meses = 0;
	
		if($date2 == null){
			$date2 = date('Y-m-d');
		}
	
		$tDate1 = strtotime($date1);
		$tDate2 = strtotime($date2);
	
		$dif_ano = date('Y', $tDate2) - date('Y', $tDate1);
		$dif_meses = date('m', $tDate2) - date('m', $tDate1);
	
	
		$meses = 12 * $dif_ano + $dif_meses;
	
		return $meses;
	}

	/*
	*
	*/
	public static function listDataToken($arr=null, $valueField='id', $textField='name', $json=true){
		if ($arr == null || $arr == '') return ($json) ? '[]' : array();

		if (!is_array($arr)) {
			$criteria = new CDbCriteria();
			$criteria->addInCondition('cod_pessoa', explode(',',$arr));
			$arr = Pessoa::model()->findAll($criteria);
		}
			
		$result = Array(); 
		foreach($arr as $item) {
			$result[] = array('id'=>$item->$valueField,'name'=>$item->$textField); 
		}

		if($json)
			return json_encode($result);
		else return $result;
	}

}