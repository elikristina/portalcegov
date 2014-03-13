<?php

/**
 * This is the model class for table "projeto_desembolso".
 *
 * The followings are the available columns in table 'projeto_desembolso':
 * @property integer $cod_desembolso
 * @property integer $cod_verba
 * @property double $valor
 * @property string $data
 *
 * The followings are the available model relations:
 * @property ProjetoVerba $verba
 */
class ProjetoDesembolso extends CActiveRecord
{
	public $valor_antigo = 0;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoDesembolso the static model class
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
		return 'projeto_desembolso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_verba, valor, data', 'required'),
			array('cod_verba', 'numerical', 'integerOnly'=>true),
			array('valor', 'validaDesembolso'),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_desembolso, cod_verba, valor, data', 'safe', 'on'=>'search'),
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
			'verba' => array(self::BELONGS_TO, 'ProjetoVerba', 'cod_verba'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_desembolso' => 'Cod Desembolso',
			'cod_verba' => 'Cod Verba',
			'valor' => 'Valor',
			'data' => 'Data',
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

		$criteria->compare('cod_desembolso',$this->cod_desembolso);
		$criteria->compare('cod_verba',$this->cod_verba);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('data',$this->data,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 *
	 * Verifica se a verba tem saldo suficiente
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaDesembolso($attribute,$params){
		if($this->valor + $this->verba->recebido - $this->valor_antigo > $this->verba->getOrcamentado())
			$this->addError($attribute, 'Você deve especificar valor menor ou igual a R$ ' .number_format($this->verba->getOrcamentado() - $this->verba->recebido, 2, ',','.'));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::afterFind()
	 */
	public function afterFind(){
		//Salva o valor antigo
		if($this->valor != null){
			$this->valor_antigo = $this->valor;
		}
		parent::afterFind();
	}
}