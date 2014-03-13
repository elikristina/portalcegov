<?php

/**
 * This is the model class for table "endereco".
 *
 * The followings are the available columns in table 'endereco':
 * @property integer $cod_endereco
 * @property integer $cod_pessoa
 * @property string $logradouro
 * @property string $numero
 * @property string $complemento
 * @property string $bairro
 * @property string $cidade
 * @property string $tipo
 * @property string $cep
 * @property string $pais
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property Pessoa $codPessoa
 */
class Endereco extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Endereco the static model class
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
		return 'endereco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, logradouro, numero, bairro, cidade, tipo, cep, pais, estado', 'required'),
			array('cod_pessoa', 'numerical', 'integerOnly'=>true),
			array('complemento, logradouro, numero, bairro, cidade, tipo, cep, pais, estado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_endereco, cod_pessoa, logradouro, numero, complemento, bairro, cidade, tipo, cep, pais, estado', 'safe', 'on'=>'search'),
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
			'pessoa' => array(self::BELONGS_TO, 'Pessoa', 'cod_pessoa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_endereco' => 'Cod Endereco',
			'cod_pessoa' => 'Cod Pessoa',
			'logradouro' => 'Logradouro',
			'numero' => 'Numero',
			'complemento' => 'Complemento',
			'bairro' => 'Bairro',
			'cidade' => 'Cidade',
			'tipo' => 'Tipo',
			'cep' => 'Cep',
			'pais' => 'País',
			'estado' => 'Estado',
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

		$criteria->compare('cod_endereco',$this->cod_endereco);
		$criteria->compare('cod_pessoa',$this->cod_pessoa);
		$criteria->compare('logradouro',$this->logradouro,true);
		$criteria->compare('numero',$this->numero,true);
		$criteria->compare('complemento',$this->complemento,true);
		$criteria->compare('bairro',$this->bairro,true);
		$criteria->compare('cidade',$this->cidade,true);
		$criteria->compare('tipo',$this->tipo,true);
		$criteria->compare('cep',$this->cep,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('estado',$this->estado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}