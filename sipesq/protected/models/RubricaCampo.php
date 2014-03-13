<?php

/**
 * This is the model class for table "rubrica_campo".
 *
 * The followings are the available columns in table 'rubrica_campo':
 * @property integer $cod_campo
 * @property integer $cod_rubrica
 * @property string $chave
 * @property integer $tipo
 *
 * The followings are the available model relations:
 * @property Rubrica $codRubrica
 */
class RubricaCampo extends CActiveRecord
{
	const CAMPO_TEXTO = 1;
	const CAMPO_TEXTO_LONGO = 2;
	const CAMPO_DATA = 3;
	const CAMPO_ANEXO = 4;
	
	public $campos = array(
	self::CAMPO_TEXTO=>'Texto'
	, self::CAMPO_TEXTO_LONGO=>'Texto Longo'
	, self::CAMPO_DATA=>'Data'
	, self::CAMPO_ANEXO=>'Arquivo'
	);
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RubricaCampo the static model class
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
		return 'rubrica_campo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_rubrica, chave, tipo', 'required'),
			array('cod_rubrica, tipo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_campo, cod_rubrica, chave, tipo', 'safe', 'on'=>'search'),
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
			'rubrica' => array(self::BELONGS_TO, 'Rubrica', 'cod_rubrica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_campo' => 'ID',
			'cod_rubrica' => 'Rubrica',
			'chave' => 'Nome do Campo',
			'tipo' => 'Tipo de Dado',
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

		$criteria->compare('cod_campo',$this->cod_campo);
		$criteria->compare('cod_rubrica',$this->cod_rubrica);
		$criteria->compare('chave',$this->chave,true);
		$criteria->compare('tipo',$this->tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}