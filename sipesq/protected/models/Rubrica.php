<?php

/**
 * This is the model class for table "rubrica".
 *
 * The followings are the available columns in table 'rubrica':
 * @property integer $cod_rubrica
 * @property string $nome
 * @property string $numero
 * @property string $descricao
 *
 * The followings are the available model relations:
 * @property ProjetoDespesa[] $despesas
 * @property ProjetoReceita[] $receitas
 * @property RubricaCampo[] $campos
 * @property Rubrica[] $filhas
 * @property Rubrica $pai
 */
class Rubrica extends CActiveRecord
{
	
	public $valor_gasto = 0;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Rubrica the static model class
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
		return 'rubrica';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, numero, descricao', 'required'),
			array('numero', 'safe'),
			array('cod_rubrica_pai', 'numerical', 'integerOnly'=>true	),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_rubrica, cod_rubrica_pai, nome, numero, descricao', 'safe', 'on'=>'search'),
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
			'despesas' => array(self::HAS_MANY, 'ProjetoDespesa', 'cod_rubrica'),
			//'receitas' => array(self::HAS_MANY, 'ProjetoVerba', 'cod_rubrica'),
			'receitas' => array(self::MANY_MANY, 'ProjetoVerba', 'projeto_verba_rubrica(cod_rubrica, cod_verba)'),
			'orcamentos' => array(self::HAS_MANY, 'ProjetoOrcamento', 'cod_rubrica'),
			'campos' => array(self::HAS_MANY, 'RubricaCampo', 'cod_rubrica'),
			'filhas' => array(self::HAS_MANY, 'Rubrica', 'cod_rubrica_pai'),
			'pai' => array(self::BELONGS_TO, 'Rubrica', 'cod_rubrica_pai'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_rubrica' => 'ID',
			'nome' => 'Nome',
			'numero' => 'Número',
			'descricao' => 'Descrição',
			'cod_rubrica_pai' => 'Rubrica Pai',	
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

		$criteria->compare('cod_rubrica',$this->cod_rubrica);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * 
	 * Imprime uma árvore 
	 * @param Rubrica $father
	 */
	 public static function printChildren($father){
	 		if($father != null){
	 			echo $father->nome .'>>';
	 			foreach ($father->filhas as $filha){
	 				//echo '->>' .$filha->nome;
	 				Rubrica::printChildren($filha);
	 			}
	 		}
	 		
	 		/*
	 		if($father != null)		
			foreach($father->filhas as $filha){
				printChildren($filha);
			}
			*/
	}
	
	/**
	 * Executado após o find no DB
	 * @see db/ar/CActiveRecord::afterFind()
	 */
	public function afterFind(){
		//$this->calculaGastos($this);
		parent::afterFind();
	}

	/**
	 * 
	 * Função recursiva para calcular os gastos de uma rubrica e suas filhass
	 * @param Rubrica $rubrica
	 */
	public function calculaGastos($rubrica=null, $cod_projeto){
		$val = 0;
		if($rubrica != null){
			
			foreach($rubrica->despesas as $desp){
				if($desp->cod_projeto == $cod_projeto)
					$val += $desp->valor_comprometido;
			}
			
			foreach($rubrica->filhas as $filha){
				$val += $this->calculaGastos($filha, $cod_projeto);
			}
			
		}
		
		return $val; 
	}

	/**
	 * 
	 * Função recursiva para calcular os gastos de uma rubrica e suas filhass
	 * @param Rubrica $rubrica
	 */
	public function calculaReceitas($rubrica=null, $cod_projeto){
		$val = 0;
		if($rubrica != null){
			
			foreach($rubrica->receitas as $res){
				if($res->cod_projeto == $cod_projeto)
					$val += $res->valor;
			}
			
			foreach($rubrica->filhas as $filha){
				$val += $this->calculaReceitas($filha, $cod_projeto);
			}
			
		}
		
		return $val; 
	}
	
	
	

	/**
	 *
	 * Função recursiva para calcular os gastos de uma rubrica e suas filhass
	 * @param Rubrica $rubrica
	 */
	public function gastosCorrentes($rubrica=null, $cod_projeto){
		//@var $dsp ProjetoDespesa  
		$val = 0;
		if($rubrica != null){
			
				
			foreach($rubrica->despesas as $dsp){
				if($dsp->cod_projeto == $cod_projeto)
					$val += $dsp->valor_corrente;
				
			}
				
			foreach($rubrica->filhas as $filha){
				$val += $this->gastosCorrentes($filha, $cod_projeto);
			}
				
		}
	
		return $val;
	}
	
	
	/**
	 *
	 * Função recursiva para calcular os gastos de uma rubrica e suas filhass
	 * @param Rubrica $rubrica
	 */
	public function getOrcamento($rubrica=null, $cod_projeto){
		//@var $dsp ProjetoDespesa
		$val = 0;
		if($rubrica != null){
				
	
			foreach($rubrica->orcamentos as $orc){
				if($orc->cod_projeto == $cod_projeto)
					$val += $orc->valor;
	
			}
	
			foreach($rubrica->filhas as $filha){
				$val += $this->getOrcamento($filha, $cod_projeto);
			}
	
		}
	
		return $val;
	}
	
	/**
	 *
	 * Função recursiva para calcular os gastos de uma rubrica e suas filhass
	 * @param Rubrica $rubrica
	 */
	public function getOrcamentado($cod_projeto){
		
		$valor = Yii::app()->db->createCommand()
		->select('sum(valor)')
		->from('projeto_orcamento')
		->where('cod_projeto=:id AND cod_rubrica = :r', array(':id'=>$cod_projeto, ':r'=>$this->cod_rubrica))
		->queryScalar();
		
		return ($valor != null) ? $valor : 0;
	}
	
	/**
	 * Calcula o saldo que esta rubrica tem na vera passada
	 * @param unknown $cod_verba
	 */
	public function getSaldo($cod_verba){
	
		$receita = ProjetoVerba::model()->findByPk($cod_verba);
		
		$gasto_rubrica = $receita->gastosComprometidos($this);
		
		$recebido = $gasto_rubrica
		+ min($receita->saldo_comprometido,
				($receita->projeto->getOrcamentado($this->cod_rubrica) - $gasto_rubrica)
		);
		
		$gasto_comprometido = $receita->gastosComprometidos($this);
	
		$saldo = $recebido - $gasto_comprometido;
	
		return $saldo;
	}
	 
}