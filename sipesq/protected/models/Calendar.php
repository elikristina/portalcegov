<?php

/**
*
*/

/*
 * pensar na marcaÃ§Ã£o dos relatÃ³rios
*/

class Calendar
{

	/**
	 * Returns the static model of the specified AR class.
	 * @return Atividade the static model class
	 */
	public static function atividades($from=null, $to=null, $user=null)
	{

		if ($user == null) $user = Yii::app()->getId();
		
		$params = array();
		
		if($from == null || $to == null){
			$params['start'] = date('Y-m-d');
			$params['end'] = date('Y-m-d');
		}
		else{
			$params['start'] = date('Y-m-d', $from / 1000);
			$params['end'] =  date('Y-m-d', $to / 1000);
		}

		//Cria comando para execução
		$where = " ((data_inicio >= :start AND data_inicio <= :end) OR (data_fim >= :start AND data_fim <= :end)) ";
		$where .= " AND atividade.cod_atividade = atividade_pessoa.cod_atividade ";
		$where  .= " AND atividade.estagio = FALSE";
		

		$where .= " AND atividade_pessoa.cod_pessoa = :id";
		$params['id'] = Yii::app()->user->getId();

		$union = implode(" ", array(
			"SELECT nome_atividade, data_inicio, data_fim, atividade.cod_pessoa, atividade.cod_atividade",
			"FROM atividade",
			"WHERE cod_pessoa = :id AND estagio = FALSE ",
			" AND ((data_inicio >= :start AND data_inicio <= :end) OR (data_fim >= :start AND data_fim <= :end))",
		)); 
		

		$command =  Yii::app()->db->createCommand()
		->select('nome_atividade, data_inicio, data_fim, atividade_pessoa.cod_pessoa, atividade.cod_atividade')
		->where($where, $params)
		->from('atividade, atividade_pessoa')
		->union($union);


		$results = $command->queryAll();
		
		$atividades = function($atv){
			$result = array(
					'id'=> "" .$atv['cod_atividade']
					,'title'=>$atv['nome_atividade']
					,'url'=>"" .Yii::app()->createUrl('/atividade/view', array('id'=>$atv['cod_atividade']))
					,'class'=>'event-important'
					,'start'=>""  .strtotime($atv['data_fim']) * 1000 + 3600
					,'end'=>"" .strtotime($atv['data_fim']) * 1000 + 3600*2
			);
			return $result;
		};
		
		return array_map($atividades, $results);
		
	}
	
	
	public static function projetos($from, $to){
		
		//Verifica se tem permissoes para projetos
		if(Sipesq::getPermition('projeto.informacoes') < 1)	 return array();

		$params = array();
		
		if($from == null|| $to == null){
			$params['start'] = date('Y-m-d');
			$params['end'] = date('Y-m-d');
		}
		else{
			$params['start'] = date('Y-m-d', $from / 1000);
			$params['end'] =  date('Y-m-d', $to / 1000);
		}
		
		//Cria comando para execução
		$where = " ((data_inicio >= :start AND data_inicio <= :end) OR (data_fim >= :start AND data_fim <= :end)) ";
		
		
		$command =  Yii::app()->db->createCommand()
		->select('nome, data_fim, data_inicio, cod_projeto')
		->where($where, $params)
		->from('projeto');
		
		$results = $command->queryAll();
		
		$map = function($atv){
			$result = array(
					'id'=> "" .$atv['cod_projeto']
					,'title'=>$atv['nome']
					,'url'=>"" .Yii::app()->createUrl('/projeto/view', array('id'=>$atv['cod_projeto']))
					,'class'=>'event-info'
					,'start'=>""  .strtotime($atv['data_fim']) * 1000 + 3600
					,'end'=>"" .strtotime($atv['data_fim']) * 1000 + 3600*2
			);
			return $result;
		};
		
		return array_map($map, $results);
		
	}


	/**
	 * Returns the static model of the specified AR class.
	 * @return Atividade the static model class
	 */
	public static function passos($from=null, $to=null)
	{
		
		$params = array();
		
		if($from == null || $to == null){
			$params['start'] = date('Y-m-d');
			$params['end'] = date('Y-m-d');
		}
		else{
			$params['start'] = date('Y-m-d', $from / 1000);
			$params['end'] =  date('Y-m-d', $to / 1000);
		}
		
		//Cria comando para execução
		$where = " (data_prazo >= :start AND data_prazo <= :end) ";
		
		//Se não for do suporte mostra só as atividades dele
		$where .= " AND cod_pessoa = :id ";
		$where .= " AND finalizado = FALSE";
		$params['id'] = Yii::app()->user->getId();
		
		$command =  Yii::app()->db->createCommand()
		->select('descricao, data_prazo, cod_pessoa, cod_passo, cod_atividade')
		->where($where, $params)
		->from('atividade_passo');
		
		$results = $command->queryAll();
		
		$func_map = function($passo){
			$result = array(
					'id'=> "" .$passo['cod_passo']
					,'title'=>$passo['descricao']
					,'url'=>"" .Yii::app()->createUrl('/atividade/view', array('id'=>$passo['cod_atividade']))
					,'class'=>'event-special'
					,'start'=>""  .strtotime($passo['data_prazo']) * 1000 + 3600
					,'end'=>"" .strtotime($passo['data_prazo']) * 1000 + 3600*2
			);
			return $result;
		};
		
		return array_map($func_map, $results);
	}
	
	public static function projetosPessoa($from, $to){
		
		
		$params = array();
		if($from == null|| $to == null){
			$params['start'] = date('Y-m-d');
			$params['end'] = date('Y-m-d');
		}
		else{
			$params['start'] = date('Y-m-d', $from / 1000);
			$params['end'] =  date('Y-m-d', $to / 1000);
		}
		
		$criteria = new CDbCriteria();
		$criteria->params = $params;
		$criteria->select = 'cod_pessoa';
		$criteria->with = array(
				"projetos"=>array('select'=>"cod_projeto, nome, data_fim")
			,	"projetos_atuante"=>array('select'=>"cod_projeto, nome, data_fim")
			,	"permissao_projeto"=>array('select'=>"cod_projeto, nome, data_fim")		
		);
		
		$criteria->addCondition("(projetos.data_fim >= :start AND projetos.data_fim <= :end)", "OR");
		$criteria->addCondition("(projetos_atuante.data_fim >= :start AND projetos_atuante.data_fim <= :end)", "OR");
		$criteria->addCondition("(permissao_projeto.data_fim >= :start AND permissao_projeto.data_fim <= :end)", "OR");
		
		$id = Yii::app()->user->getId();
		$pessoa = Pessoa::model()->findByPk($id, $criteria);
		
		$map = function($projeto){
			$result = array(
					'id'=> "" .$projeto->cod_projeto
					,'title'=>$projeto->nome
					,'url'=>"" .Yii::app()->createUrl('/projeto/view', array('id'=>$projeto->cod_projeto))
					,'class'=>'event-info'
					,'start'=>""  .strtotime($projeto->data_fim) * 1000 + 3600
					,'end'=>"" .strtotime($projeto->data_fim) * 1000 + 3600*2
			);
			return $result;
		};
		
		$result = array_merge(
				array_map($map, $pessoa->projetos)
			,	array_map($map, $pessoa->projetos_atuante)
			,	array_map($map, $pessoa->permissao_projeto)		
		);
		return $result;
	}

}