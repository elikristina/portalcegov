<?php

/**
 * This is the model class for table "pessoa_categoria".
 *
 * The followings are the available columns in table 'pessoa_categoria':
 * @property integer $cod_pessoa
 * @property integer $cod_categoria
 */
class PessoaCategoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PessoaCategoria the static model class
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
		return 'pessoa_categoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, cod_categoria', 'required'),
			array('cod_pessoa, cod_categoria', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_pessoa, cod_categoria', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_pessoa' => 'Cod Pessoa',
			'cod_categoria' => 'Cod Categoria',
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

		$criteria->compare('cod_pessoa',$this->cod_pessoa);
		$criteria->compare('cod_categoria',$this->cod_categoria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}