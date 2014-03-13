<?php

/**
 * This is the model class for table "projeto_despesa_info".
 *
 * The followings are the available columns in table 'projeto_despesa_info':
 * @property integer $cod_info
 * @property integer $cod_despesa
 * @property string $chave
 * @property string $valor
 * @property integer $tipo
 *
 * The followings are the available model relations:
 * @property ProjetoDespesa $codDespesa
 */
class ProjetoDespesaInfo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoDespesaInfo the static model class
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
		return 'projeto_despesa_info';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_despesa, chave, tipo', 'required'),
			array('cod_despesa, tipo', 'numerical', 'integerOnly'=>true),
			array('valor', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_info, cod_despesa, chave, valor, tipo', 'safe', 'on'=>'search'),
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
			'despesa' => array(self::BELONGS_TO, 'ProjetoDespesa', 'cod_despesa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_info' => 'Cod Info',
			'cod_despesa' => 'Cod Despesa',
			'chave' => 'Chave',
			'valor' => 'Valor',
			'tipo' => 'Tipo',
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

		$criteria->compare('cod_info',$this->cod_info);
		$criteria->compare('cod_despesa',$this->cod_despesa);
		$criteria->compare('chave',$this->chave,true);
		$criteria->compare('valor',$this->valor,true);
		$criteria->compare('tipo',$this->tipo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}