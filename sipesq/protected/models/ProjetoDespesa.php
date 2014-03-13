<?php

/**
 * This is the model class for table "projeto_despesa".
 *
 * The followings are the available columns in table 'projeto_despesa':
 * @property integer $cod_despesa
 * @property integer $cod_rubrica
 * @property double $valor
 * @property string $comprador
 * @property string $data_compra
 * @property integer $cod_projeto
 * @property integer $cod_verba
 * @property string $documento
 * @property string $descricao
 * @property string $data_inclusao
 * @property integer $cod_criador
 * @property string $data_edicao
 * @property integer $quantidade
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property ProjetoDespesaInfo[] $infos
 * @property Rubrica $rubrica
 * @property Projeto $projeto
 * @property Pessoa $criador
 * @property ProjetoVerba $verba
 * @property Patrimonio[] $patrimonios
 * @property double gasto_patrimonios
 */
class ProjetoDespesa extends CActiveRecord
{
	
	public $valor_comprometido = 0; //valor * quantidade
	public $valor_corrente = 0; // valor * ( data_hoje - data_inicial) -> OBS: data_hoje - data_inicial se limita ao numero 'quantidade'
	public $valor_antigo = 0; // Valor do objeto antes de ser atualizado pelo formulário
	public $meses;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoDespesa the static model class
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
		return 'projeto_despesa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_rubrica, quantidade, nome, valor, comprador, data_compra, cod_projeto, data_inclusao, cod_criador, data_edicao', 'required'),
			array('cod_rubrica, cod_projeto, cod_criador', 'numerical', 'integerOnly'=>true),
			array('documento, descricao, valor', 'safe'),
			//array('valor', 'validaSaldoRub'),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_despesa, cod_rubrica, valor, comprador, data_compra, cod_projeto, documento, descricao, data_inclusao, cod_criador, data_edicao', 'safe', 'on'=>'search'),
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
			'infos' => array(self::HAS_MANY, 'ProjetoDespesaInfo', 'cod_despesa',),
			'rubrica' => array(self::BELONGS_TO, 'Rubrica', 'cod_rubrica'),
			'projeto' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto'),
			'criador' => array(self::BELONGS_TO, 'Pessoa', 'cod_criador'),
			'verba'=> array(self::BELONGS_TO, 'ProjetoVerba', 'cod_verba'),			
			'patrimonios'=> array(self::HAS_MANY, 'Patrimonio', 'cod_projeto_despesa'),
			'gasto_patrimonios'=>array(self::STAT, 'Patrimonio','cod_projeto_despesa' ,'select'=>'SUM(valor)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_despesa' => 'Despesa',
			'cod_rubrica' => 'Rubrica',
			'valor' => 'Valor Unitário',
			'quantidade' => 'Duração (meses)',
			'comprador' => 'Beneficiário(s)',
			'data_compra' => 'Data da Compra',
			'cod_projeto' => 'Projeto',
			'documento' => 'Outros Documentos',
			'nome'=>'Nome do Gasto',
			'descricao' => 'Comentários',
			'data_inclusao' => 'Data de Inclusão',
			'cod_criador' => 'Criador',
			'data_edicao' => 'Data de Edição',
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

		$criteria->compare('cod_despesa',$this->cod_despesa);
		$criteria->compare('cod_rubrica',$this->cod_rubrica);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('quantidade',$this->quantidade);
		$criteria->compare('comprador',$this->comprador,true);
		$criteria->compare('data_compra',$this->data_compra,true);
		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('data_inclusao',$this->data_inclusao,true);
		$criteria->compare('cod_criador',$this->cod_criador);
		$criteria->compare('data_edicao',$this->data_edicao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::afterFind()
	 */
	public function afterFind(){
		
		//Salva o valor antigo
		if($this->valor != null) $this->valor_antigo = $this->valor;
		
		
		//Calcula os meses correntes
		$this->meses = Sipesq::difMeses($this->data_compra);
		
		//Calcula o valor comprometido
		$this->valor_comprometido = $this->valor * $this->quantidade;
		
		
		//Calcula o valor corrente
		$meses_correntes = $this->quantidade - $this->meses;
		
		if($meses_correntes > 0){
			//Ainda está ativo
			if($this->meses > 0) //evita que não calcule quanto está no mês atual
				$this->valor_corrente = $this->valor * $this->meses + $this->gasto_patrimonios;
			else {

				if ($this->meses >= 0)
					$this->valor_corrente = $this->valor + $this->gasto_patrimonios;
				else
					$this->valor_corrente = 0; //despesa está no futuro. Nao calcula ainda.
			}
				
			
		}else{
			//Já expirou 
			$this->valor_corrente = $this->valor * $this->quantidade;
		}
		
		parent::afterFind();
	}
	

	/**
	 * Verifica se a verba tem saldo suficiente
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaSaldo($attribute,$params){
		
			if($this->valor * $this->quantidade - $this->valor_antigo > $this->verba->saldo_comprometido)
				$this->addError($attribute, 'Você deve especificar valor menor ou igual a R$ ' .number_format($this->verba->saldo_comprometido, 2, ',','.'));
	}
	
	public function validaSaldoRub($attribute, $params){

		
		$receita = ProjetoVerba::model()->findByPk($this->cod_verba);
		$rubrica = Rubrica::model()->findByPk($this->cod_rubrica);
		$gasto_rubrica = $receita->gastosComprometidos($rubrica);
		
		$recebido = $gasto_rubrica
		+ min($receita->saldo_comprometido,
				($receita->projeto->getOrcamentado($rubrica->cod_rubrica) - $gasto_rubrica)
		);
		
		$gasto_comprometido = $receita->gastosComprometidos($rubrica);
		$saldo = $recebido - $gasto_comprometido;
		
		if($this->valor * $this->quantidade - $this->valor_antigo > $saldo){
			$message = "Você tentou adicionar uma despesa de R$" .Yii::app()->format->number($this->valor * $this->quantidade);
			$message .= "<br> Saldo disponível: R$" .Yii::app()->format->number($saldo);
			$message .= "<br> Rubrica: " .$rubrica->nome;
			$this->addError($attribute, $message);
		}
			
	}

	public function getSaldoRubrica(){
					$rubrica = Rubrica::model()->findByPk($this->cod_rubrica);
					$gasto_comprometido = $this->verba->gastosComprometidos($rubrica);
					$recebido = $gasto_comprometido
					+ min($this->verba->saldo_comprometido, ($this->projeto->getOrcamentado($this->cod_rubrica) - $gasto_comprometido));

					return $recebido - $gasto_comprometido;
	}	
}