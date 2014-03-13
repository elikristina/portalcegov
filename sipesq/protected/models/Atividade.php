<?php

/**
 * This is the model class for table "atividade".
 *
 * The followings are the available columns in table 'atividade':
 * @property integer $cod_atividade
 * @property integer $cod_pessoa 
 * @property $tipo_vinculo ?
 * @property string $nome_atividade
 * @property string $descricao
 * @property string $data_inicio
 * @property string $data_fim
 * @property $turnos_trabalho ?
 * @property $estagio ?
 * @property string $data_edicao
 * @property string $data_criacao
 * @property string $data_realizacao - conclusao
 * @property $em_andamento
 * @property $status
 * 
 *
 *
 * The followings are the available model relations:
 * @property PessoaFinanceiro[] $bolsas
 * @property Projeto[] $projetos
 * @property Pessoa[] $pessoas
 * @property AtividadePasso[] $passos
 * * @property AtividadePasso[] $passos_abertos
 * * @property AtividadePasso[] $passos_finalizados
 * @property Pessoa $responsavel
 * @property AtividadeCategoria $categoria
 */

/*
 * pensar na marcaÃ§Ã£o dos relatÃ³rios
 */

class Atividade extends CActiveRecord
{
	public $class;
	public $label;
	public $statusName;
	public $icon; //icone do Bootstrap do twitter
	public $jIcon; //icone do jquery UI

	/**
	 * Returns the static model of the specified AR class.
	 * @return Atividade the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'atividade';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, nome_atividade, cod_categoria, descricao, data_inicio, data_fim, status', 'required'),
			array('projetos', 'validaProjetos'),
			array('pessoas', 'validaPessoas'),
			array('estagio', 'boolean'),
			array('cod_pessoa, cod_categoria, status', 'numerical', 'integerOnly'=>true),			
			array('status, data_realizacao, estagio', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_atividade, cod_pessoa, tipo_vinculo, nome_atividade, descricao, data_inicio, data_fim, turnos_trabalho, estagio', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'projetos' => array(self::MANY_MANY, 'Projeto', 'atividade_projeto(cod_atividade, cod_projeto)', 'select'=>'cod_projeto, nome'),
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'atividade_pessoa(cod_atividade, cod_pessoa)', 'select'=>'cod_pessoa, nome, nome_curto'),
			'responsavel' => array(self::BELONGS_TO, 'Pessoa', 'cod_pessoa','select'=>'cod_pessoa, nome, nome_curto'),
			'categoria' => array(self::BELONGS_TO, 'AtividadeCategoria', 'cod_categoria'),
			'passos' => array(self::HAS_MANY, 'AtividadePasso', 'cod_atividade', 'order'=>'data_prazo'),			
			'meus_passos' => array(self::HAS_MANY, 'AtividadePasso', 'cod_atividade', 'order'=>'data_prazo', 'condition'=>'meus_passos.cod_pessoa = :cod_pessoa', 'params'=>array('cod_pessoa'=>isset($_POST['options']['pessoa']) ? $_POST['options']['pessoa'] : Yii::app()->user->getId())),
			'passos_finalizados' => array(self::HAS_MANY, 'AtividadePasso', 'cod_atividade', 'order'=>'data_prazo', 'condition'=>'finalizado = true'),
			'passos_abertos' => array(self::HAS_MANY, 'AtividadePasso', 'cod_atividade', 'order'=>'data_prazo', 'condition'=>'finalizado = false'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_atividade' => 'ID',
			'cod_pessoa' => 'Responsável',
			'tipo_vinculo' => 'Tipo de Vínculo',
			'nome_atividade' => 'Nome da Atividade',
			'descricao' => 'Descrição',
			'data_inicio' => 'Data de Início',
			'data_fim' => 'Data de Fim',
			'turnos_trabalho' => 'Turnos de Trabalho',
			'estagio' => 'Finalizado', //amarelo (andamento) ,Verde(Finalizado), Vermelho(Atrasado)
			'responsavel'=>'Responsável',
			'status'=>'Estágio',
			'data_criacao'=>'Data de criação',
			'data_edicao'=>'Útima Edição',
			
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('nome_atividade',$this->nome_atividade,true);
		$criteria->compare('data_inicio',$this->data_inicio,true);
		$criteria->compare('data_fim',$this->data_fim,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	protected function afterFind(){
		$this->calculaStatus();
		
		parent::afterFind();
	}

	protected function beforeSave(){
		if($this->estagio && $this->data_realizacao == null)
			$this->data_realizacao = date('Y-m-d');
		
		if(!$this->estagio)
			$this->data_realizacao = null;
		return true;
	}

	private function calculaStatus(){

		if($this->estagio){
			$this->label="label-success";
			$this->statusName = 'Atividade Finalizada';
			$this->icon = "icon-ok";
			$this->jIcon = "ui-icon ui-icon-check";
		}else{
			$this->label="label-info";
			$this->statusName ="A Fazer";
			$this->icon = "icon-time";
			$this->jIcon = "ui-icon ui-icon-clock";
		}		
	}
	
	/**
	 * 
	 * Retorna as atividades que acabam em 6 meses 
	 */
	public static function getLasts(){
		$criteria=new CDbCriteria;
		$dataLimite =  date("Y-m-d", mktime(0, 0, 0, date("m") + 6, date("d"), date("Y")));
		$dataAtual = date("Y-m-d");
		$criteria->addCondition("t.data_fim <= '$dataLimite'", 'AND');
		$criteria->addCondition("t.data_fim >= '$dataAtual'", 'AND');
		$criteria->order = 't.data_fim DESC, t.nome_atividade ASC';
		return Atividade::model()->findALL($criteria);;
	}

	/**
	 *
	 * Retorna as atividades que uma pessoa participa  e nao e responsavel
	 * @param Pessoa $user
	 * @return Atividade[]
	 */
	public static function getAtividadesUserParticipa($pessoa){
	
		if($pessoa == null){
			return array();
		}
	
		$cod_pessoa = $pessoa->cod_pessoa;
	
		$criteria=new CDbCriteria;
		$criteria->with = array('pessoas');
		$criteria->addCondition("pessoas.cod_pessoa = $cod_pessoa", 'AND');
		$criteria->addCondition("t.cod_pessoa <> $cod_pessoa");
		$criteria->order = 't.data_fim ASC, t.nome_atividade ASC';
		return Atividade::model()->findALL($criteria);;
	}	
/**
	 * 
	 * Retorna as atividades que acabam em 6 meses que um determinado
	 * usuÃ¡rio PARTICIPA
	 * @param Pessoa $user
	 * @return Atividade[]
	 */
	public static function getAllByUser($user){
		
		if($user == null){
			//Se a pessoa nÃ£o contÃ©m login retorna um array vazio
			return array();
		}
		
		$cod_pessoa = $user->cod_pessoa; 
		
		$criteria=new CDbCriteria;
		$criteria->with = array('pessoas');
		$criteria->addCondition("pessoas.cod_pessoa = $cod_pessoa", 'AND');
		$criteria->addCondition("t.estagio = false", 'AND');
		$criteria->order = 't.data_fim ASC, t.nome_atividade ASC';
		return Atividade::model()->findALL($criteria);;
	}
	
	
	/**
 	 * 
	 * Retorna as atividades que acabam em 6 meses que um determinado
	 * usuÃ¡rio Ã‰ RESPONSÃ�VEL
	 * @param Pessoa $user
	 * @return Atividade[]
	 */
	public static function getAllRespByUser($user){
		
		if($user == null){
			//Se a pessoa nÃ£o contÃ©m login retorna um array vazio
			return array();
		}
		
		$cod_pessoa = $user->cod_pessoa; 
		
		$criteria=new CDbCriteria;
		$criteria->addCondition("t.cod_pessoa = $cod_pessoa", 'AND');
		$criteria->addCondition("t.estagio = false", 'AND');
		$criteria->order = 't.data_fim ASC, t.nome_atividade ASC';
		return Atividade::model()->findALL($criteria);;
	}
	
	
	/**
	 * 
	 * Valida o projeto
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaProjetos($attribute,$params){
			 if(count($this->$attribute) < 1)
			 	$this->addError($attribute, 'Você deve especificar pelo menos um projeto.');
	}
	
	/**
	 * 
	 * Valida as pessoas
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaPessoas($attribute, $params){
			if(count($this->$attribute) < 1)
			 	$this->addError($attribute, 'Você deve especificar pelo menos uma pessoa.');
	}
	
	/**
	 * Verifica se o usuario eh responsavel por esta atividade 
	 * ou se eh coordenador de algum projeto desta atividade
	 * @param integer $id - Identificador do usuario
	 */
	public function isResponsible($id){

		if ($this->cod_pessoa == $id) return true;		

		foreach($this->projetos as $projeto){
			if ($projeto->isSupport($id)) return true;
		}
		return false;
	}
	
	/**
	 *
	 * @param integer $id - Identificador do usuario
	 */
	public function hasStep($id){
		return (bool)Yii::app()->db->createCommand()
		->select('count(cod_pessoa)')
		->where("cod_atividade = :atv AND cod_pessoa = :id", array('id'=>$id,'atv'=>$this->cod_atividade))
		->from('atividade_passo')
		->queryScalar();
	}
	
	/**
	 * Verifica se o usuario $id participa desta atividade
	 * @param integer $id - Identificador do usuario
	 */
	public function isParticipating($id = null){

		if($id === null) $id = Yii::app()->user->getId();

		return ((bool)Yii::app()->db->createCommand()
		->select('count(cod_pessoa)')
		->where("cod_atividade = :atv AND cod_pessoa = :id", array('id'=>$id,'atv'=>$this->cod_atividade))
		->from('atividade_pessoa')
		->queryScalar()  || ($this->cod_pessoa == $id));
	}
}