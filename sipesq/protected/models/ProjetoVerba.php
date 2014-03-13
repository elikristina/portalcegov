<?php

/**
 * This is the model class for table "projeto_verba".
 *
 * The followings are the available columns in table 'projeto_verba':
 * @property integer $cod_verba
 * @property integer $cod_rubrica
 * @property integer $cod_projeto
 * @property string $data_desembolso
 * @property string $descricao
 * @property real $valor
 *
 * The followings are the available model relations:
 * @property Rubrica $rubrica
 * @property Rubrica[] $rubricas
 * @property ProjetoDesembolso[] $desembolsos
 * @property ProjetoDespesa[] $despesas
 * @property Projeto $projeto
 * @property real $recebido
 * @property real $saldo_comprometido
 * @property real $saldo_corrente
 * @property real $gasto_comprometido - valor * qtd. Contabiliza a duracao
 * @property real $gasto_corrente - valor. Nao conta a duracao
 */
class ProjetoVerba extends CActiveRecord
{
	public $gasto_corrente = 0;
	public $gasto_comprometido = 0;
	public $saldo_comprometido = 0;
	public $saldo_corrente = 0;
	
	public $nome_rubricas = '';
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoVerba the static model class
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
		return 'projeto_verba';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_projeto, valor', 'required'),
			array('cod_projeto', 'numerical', 'integerOnly'=>true),
			array('rubricas', 'validaRubricas'),
			//array('desembolsos', 'validaDesembolsos'),
			//array('valor', 'numerical'),
			array('data_desembolso, descricao, rubricas', 'safe'),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_verba, cod_rubrica, cod_projeto, data_desembolso, descricao', 'safe', 'on'=>'search'),
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
			'projeto' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto'),
			'rubricas' => array(self::MANY_MANY, 'Rubrica', 'projeto_verba_rubrica(cod_rubrica, cod_verba)'),
			'desembolsos' =>array(self::HAS_MANY, 'ProjetoDesembolso', 'cod_verba'),
			'despesas' =>array(self::HAS_MANY, 'ProjetoDespesa', 'cod_verba', 'order'=>'data_compra desc'),
			'recebido'=>array(self::STAT, 'ProjetoDesembolso','cod_verba' ,'select'=>'SUM(valor)'),
			'gasto' =>array(self::STAT, 'ProjetoDespesa', 'cod_verba', 'select'=>'SUM(valor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_verba' => 'Verba',
			'cod_rubrica' => 'Rubrica',
			'rubricas' => 'Rubricas',
			'cod_projeto' => 'Projeto',
			'data_desembolso' => 'Data de Desembolso',
			'descricao' => 'Comentários',
			'valor'=>'Desembolso Inicial',
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

		$criteria->compare('cod_verba',$this->cod_verba);
		$criteria->compare('cod_rubrica',$this->cod_rubrica);
		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('data_desembolso',$this->data_desembolso,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Retorna o quanto foi gasto desta verba
	 */
	public function getDespesas(){
	
		$criteria = new CDbCriteria();
		
		$rubricas = array();
		
		//Não há rubricas cadastradas neste projeto
		if(count($this->rubricas) < 1){
			return 0;
		}
		
		foreach($this->rubricas as $rub){
			$rubricas[] = $rub->cod_rubrica;
		}
		
		$criteria->compare('rubrica.cod_rubrica', $rubricas);
		$criteria->with = array('projeto', 'rubrica');
		$criteria->compare('projeto.cod_projeto', $this->cod_projeto);
		
		$despesas = ProjetoDespesa::model()->findAll($criteria);
		
		$soma = 0;
		foreach($despesas as $desp){
			$soma += $desp->valor; 
		}
		
		return $soma;
	}
	
	/**
	 * Retorna o quanto há disponível para esta verba
	 */
	public function getSaldo(){
		return $this->recebido - $this->gasto;
	}
	
	
	/**
	 * Retorna a soma dos valores orcamentados para as rubricas desta verba
	 */
	public function getOrcamentado(){
		
		$orcamentado = 0;
		foreach($this->rubricas as $rub){
			$orcamentado += $rub->getOrcamentado($this->cod_projeto);
		}
		
		return $orcamentado;
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::afterFind()
	 */
	public function afterFind(){
		
		$rubricas = array();
		foreach($this->rubricas as $rub){
			$rubricas[] = $rub->nome;
		}
		$this->nome_rubricas = implode(', ', $rubricas);
		
		foreach($this->despesas as $desp){
			$this->gasto_comprometido += $desp->valor_comprometido;
			$this->gasto_corrente += $desp->valor_corrente;
		}
		
		$this->saldo_comprometido = $this->recebido - $this->gasto_comprometido;
		$this->saldo_corrente = $this->recebido - $this->gasto_corrente;
	}
	
	
	/**
	 *
	 * Valida o projeto
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaRubricas($attribute,$params){
		if(count($this->$attribute) < 1)
			$this->addError($attribute, 'Você deve especificar pelo menos uma rubrica.');
	}
	
	/*
	 * Calcula o quanto foi gasto com esta rubrica nesta verba
	 * @param integer $cod_rubrica
	 * @return real
	 
	public function getGastosComprometidos($cod_rubrica){
		
		$gasto = 0;
		foreach($this->despesas as $desp){
			if($desp->cod_rubrica == $cod_rubrica)
				$gasto += $desp->valor_comprometido;
		}
		return $gasto;
		
		
	}
	
	
	/*
	 * Calcula o quanto foi gasto com esta rubrica nesta verba
	 * @param integer $cod_rubrica
	 * @return real
	 
	public function getGastosCorrentes($cod_rubrica){
		$gasto = 0;
		foreach($this->despesas as $desp){
			if($desp->cod_rubrica == $cod_rubrica)
				$gasto += $desp->valor_corrente;
		}
		return $gasto;
	}
	*/

	/**
	 * Calcula o quanto foi gasto com esta rubrica nesta verba
	 * @param integer $cod_rubrica
	 * @return real
	 */
	public function gastosCorrentes($rubrica){
		$gasto = 0;

		foreach($this->despesas as $desp){
			if($desp->cod_rubrica == $rubrica->cod_rubrica)
				$gasto += $desp->valor_corrente;
		}

		foreach ($rubrica->filhas as $filha) {
			$gasto += $this->gastosCorrentes($filha);
		}


		return $gasto;
	}

	/**
	 * Calcula o quanto foi gasto com esta rubrica nesta verba
	 * @param integer $cod_rubrica
	 * @return real
	 */
	public function gastosComprometidos($rubrica){
		
		$gasto = 0;
		foreach($this->despesas as $desp){
			if($desp->cod_rubrica == $rubrica->cod_rubrica)
				$gasto += $desp->valor_comprometido;
		}
		foreach ($rubrica->filhas as $filha) {
			$gasto += $this->gastosComprometidos($filha);
		}
		return $gasto;
		
		
	}
	
	
	
}