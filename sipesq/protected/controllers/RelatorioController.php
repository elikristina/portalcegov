<?php

class RelatorioController extends Controller
{
	
		public $layout='//layouts/column_new';
		protected $idMenu = 'menuRelatorio';
	
	
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('atividade','projeto','index','pessoas', 'projetos', 'sipesq', 'morrisFinanceiro', 'morrisSipesq', 'morrisAtividades'),				
				'expression'=>function(){												
					return (Sipesq::isSupport() || Sipesq::getPermition('gerencial.relatorios') >= 100);
				}
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actionIndex()
	{
		$this->render('index');
	}
	
	/**
	 * 
	 * Renderiza o relatÃ³rio de atividades
	 * @param date $inicio - Data de inÃ­cio da atividade
	 * @param date $termino - Data de tÃ©rmino da atividade
	 */
	public function actionAtividade($inicio=null, $termino=null, $categoria=null, $projeto=null, $finalizado=false){
		
		$criteria =new CDbCriteria;
		$criteria->with = array('categoria','projetos'=>array('together'=>true));
		
		if($inicio != null){
			$criteria->addCondition("t.data_inicio >= '$inicio'", 'AND');
		}
		
		if($termino != null){
			$criteria->addCondition("t.data_fim <= '$termino'", 'AND');
		}
		
		if($categoria != null){
			$criteria->compare('categoria.cod_categoria_pai',$categoria);
		}
		
		if($finalizado)
		 	$criteria->addCondition('t.estagio=true', 'AND');
		
		if($projeto != null){
			$criteria->compare('projetos.cod_projeto', $projeto);
		}
		
		 
		$dataProvider=new CActiveDataProvider('Atividade', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>999,),))	;
		$this->render('atividade',array(
			'dataProvider'=>$dataProvider,
			'projeto'=>$projeto,
			'categoria'=>$categoria,
			'inicio'=>$inicio,
			'termino'=>$termino,
			'finalizado'=>$finalizado,
		));
		
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param date $inicio - Projetos que iniciam a partir desta data.
	 * @param date $termino - Projetos que terminam atÃ© esta data.
	 * @param integer $projeto
	 */
	
	public function actionProjeto($stat=0, $relatorio=false){
		
		$criteria =new CDbCriteria;
		
		if($relatorio){
			$this->layout = '//layouts/relatorio';
		}
		
		if($stat != null){
			$criteria->compare("t.situacao",$stat);
		}
		
		 
		$dataProvider=new CActiveDataProvider('Projeto', array('criteria'=>$criteria,'pagination'=>array('pageSize'=>999,),))	;
		$this->render('projeto',array(
			'dataProvider'=>$dataProvider,
			'stat'=>$stat,
		));
		
	}


	public function actionSipesq(){
		//$this->layout = '//layouts/relatorio';
		$this->render('sipesq');
	}
	
	/**
	 *
	 * Renderiza o relatÃ³rio de pessoas
	 * @param date $inicio - Data de inÃ­cio das atividades a serem mostradas no relatÃ³rio
	 * @param date $termino - Data de tÃ©rmino da atividade a serem mostradas no relatÃ³rio
	 */
	public function actionPessoas($idPessoa = null, $pessoais=true, $bancarias=true, $projetos=true, $bolsas=true, $atividadesParticipa=true, $atividadesParticipaFinalizadas=true, $atividadesParticipaPassos=true, $atividadesResponsavel=true, $atividadesResponsavelFinalizadas=true, $atividadesResponsavelPassos=true, $inicio=null, $termino=null){

		if($idPessoa != null)
			$dataPessoas = array("pessoa" => Pessoa::model()->findByPk($idPessoa));
		else {
			$dataPessoas = Pessoa::model()->findAll(array('order'=>'nome'));
		}

		$this->render('pessoas',array(
				'pessoas'=>$dataPessoas, 
				'idPessoa'=>$idPessoa,
				'pessoais'=>$pessoais,
				'bancarias'=>$bancarias,
				'projetos'=>$projetos,
				'bolsas'=>$bolsas,
				'atividadesParticipa'=>$atividadesParticipa,
				'atividadesParticipaFinalizadas'=>$atividadesParticipaFinalizadas,
				'atividadesParticipaPassos'=>$atividadesParticipaPassos,
				'atividadesResponsavel'=>$atividadesResponsavel,
				'atividadesResponsavelFinalizadas'=>$atividadesResponsavelFinalizadas,
				'atividadesResponsavelPassos'=>$atividadesResponsavelPassos,
				'inicio'=>$inicio,
				'termino'=>$termino,
		));
	
	}
	public function actionMorrisSipesq(){

		$limits = Yii::app()->db->createCommand()->select('min(data_inicio), max(data_fim)')->from('projeto')->queryRow();
		$inf = date('Y', strtotime($limits['min']));
		$sup = date('Y', strtotime($limits['max']));

		//Projetos
		$projetos = array(
			'elaboracao'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 0'),
				
			'negociacao'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 1'),

			'tramitacao'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 2'),

			'andamento'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 3'),

			'prestacao'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 4'),

			'encerrado'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 5'),

			'cancelado'=>Yii::app()->db->createCommand()->select('count(*)')->from('projeto')
				->where('situacao = 6'),
				
		);

		$result = array();
		

		$result[] = array('sipesq'=>"SIPESQ"
			, 'p_elaboracao'=>$projetos['elaboracao']->queryScalar()
			, 'p_negociacao'=>$projetos['negociacao']->queryScalar()
			, 'p_tramitacao'=>$projetos['tramitacao']->queryScalar()
			, 'p_andamento'=>$projetos['andamento']->queryScalar()
			, 'p_prestacao'=>$projetos['prestacao']->queryScalar()
			, 'p_encerrado'=>$projetos['encerrado']->queryScalar()
			, 'p_cancelado'=>$projetos['cancelado']->queryScalar()
		);
		


		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($result);
		Yii::app()->end();
	}

	public function actionMorrisFinanceiro(){

		$cmdDesp =  Yii::app()->db->createCommand();
		$cmdRec =  Yii::app()->db->createCommand();

		$limits = Yii::app()->db->createCommand()
					->select('min(data_inicio), max(data_fim)')
					->from('projeto')
					->queryRow();



		//Receitas
		$cmdDesp->from('projeto_despesa');
		$cmdDesp->where = implode(' ', array(			
			'data_compra < :sup AND',
			'data_compra >= :inf',
		));		

		$cmdDesp->select = 'sum(valor * quantidade)';

		//Despesas
		$cmdRec->from('projeto_verba, projeto_desembolso');
		$cmdRec->where = implode(' ',array(
			'projeto_verba.cod_verba = projeto_desembolso.cod_verba AND',			
			'projeto_desembolso.data < :sup AND',
			'projeto_desembolso.data >= :inf'
		));

		
		$cmdRec->select = 'sum(projeto_desembolso.valor)';
				
		$inf = date('Y', strtotime($limits['min']));
		$sup = date('Y', strtotime($limits['max']));

		$result = array();

		for($year = $inf; $year <= $sup; $year++){
				
			$y0 = implode('-', array($year,01,01));
			$y1 = implode('-', array($year, 12, 31)); 

			$cmdDesp->params = array('inf'=>$y0, 'sup'=>$y1);
			$cmdRec->params = array('inf'=>$y0, 'sup'=>$y1);

			$desp = $cmdDesp->queryScalar();
			$rec = $cmdRec->queryScalar();

			$result[] = array('y'=>"{$year}"
				, 'receitas'=>($rec != null) ? $rec : 0
				, 'despesas'=>($desp != null) ? $desp: 0				
			);
		}
		

		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($result);
		Yii::app()->end();
		
	}

	public function actionMorrisAtividades(){

		$atividades =  Yii::app()->db->createCommand()
			->select('count(*)')
			->from('atividade')
			->where('data_criacao >= :inf AND data_criacao < :sup');

		$ativ_finalizadas =  Yii::app()->db->createCommand()
			->select('count(*)')
			->from('atividade')
			->where('data_realizacao >= :inf AND data_realizacao < :sup');

		$limits = Yii::app()->db->createCommand()
					->select('min(data_criacao), max(data_criacao)')
					->from('atividade')
					->queryRow();
				
		$inf = date('Y', strtotime($limits['min']));
		$sup = date('Y', strtotime($limits['max']));

		$result = array();
		for($year = $inf; $year <= $sup; $year++){
				
			$y0 = implode('-', array($year,01,01));
			$y1 = implode('-', array($year, 12, 31)); 

			$atividades->params = array('inf'=>$y0, 'sup'=>$y1);
			$ativ_finalizadas->params = array('inf'=>$y0, 'sup'=>$y1);

			$result[] = array('year'=>"{$year}"
				, 'criadas'=>$atividades->queryScalar()
				, 'finalizadas'=>$ativ_finalizadas->queryScalar()
			);
		}

		$this->layout=false;
		header('Content-type: application/json');
		echo json_encode($result);
		Yii::app()->end();
		
	}

	
}