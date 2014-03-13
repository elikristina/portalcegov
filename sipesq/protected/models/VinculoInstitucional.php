<?php

/**
 * This is the model class for table "vinculo_institucional".
 *
 * The followings are the available columns in table 'vinculo_institucional':
 * @property integer $cod_vinculo_institucional
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property Pessoa[] $pessoas
 */
class VinculoInstitucional extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return VinculoInstitucional the static model class
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
		return 'vinculo_institucional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_vinculo_institucional, nome', 'safe', 'on'=>'search'),
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
			'pessoas' => array(self::HAS_MANY, 'Pessoa', 'cod_vinculo_institucional'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_vinculo_institucional' => 'Cod Vinculo Institucional',
			'nome' => 'Nome',
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

		$criteria->compare('cod_vinculo_institucional',$this->cod_vinculo_institucional);
		$criteria->compare('nome',$this->nome,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}