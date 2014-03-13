<?php

/**
 * This is the model class for table "projeto_orcamento".
 *
 * The followings are the available columns in table 'projeto_orcamento':
 * @property integer $cod_orcamento
 * @property integer $cod_rubrica
 * @property integer $cod_projeto
 * @property double $valor
 *
 * The followings are the available model relations:
 * @property Projeto $projeto
 * @property Rubrica $rubrica
 */
class ProjetoOrcamento extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoOrcamento the static model class
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
		return 'projeto_orcamento';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_rubrica, cod_projeto', 'required'),
			array('cod_rubrica, cod_projeto', 'numerical', 'integerOnly'=>true),
			//array('valor', 'safe'),
			array('valor', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_orcamento, cod_rubrica, cod_projeto, valor', 'safe', 'on'=>'search'),
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
			'rubrica' => array(self::BELONGS_TO, 'Rubrica', 'cod_rubrica'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_orcamento' => 'Cod Orcamento',
			'cod_rubrica' => 'Cod Rubrica',
			'cod_projeto' => 'Cod Projeto',
			'valor' => 'Valor',
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

		$criteria->compare('cod_orcamento',$this->cod_orcamento);
		$criteria->compare('cod_rubrica',$this->cod_rubrica);
		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('valor',$this->valor);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}