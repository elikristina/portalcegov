<?php

/**
 * This is the model class for table "ferias".
 *
 * The followings are the available columns in table 'ferias':
 * @property integer $cod_pessoa
 * @property string $data_inicio
 * @property string $data_fim
 *
 * The followings are the available model relations:
 * @property Pessoa $pessoa
 */
class Ferias extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Ferias the static model class
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
		return 'ferias';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, data_inicio, data_fim', 'required'),
			array('cod_pessoa', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_pessoa, data_inicio, data_fim', 'safe', 'on'=>'search'),
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
			'cod_pessoa' => 'Pessoa',
			'data_inicio' => 'Início das Férias',
			'data_fim' => 'Término das Férias',
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
		$criteria->compare('data_inicio',$this->data_inicio,true);
		$criteria->compare('data_fim',$this->data_fim,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * 
	 * Exibe todas as pessoas que estão em férias
	 * @return array $pessoas - Pessoas que estão em férias
	 */
	public static function findAllInVacation(){
		$hoje = date('Y-m-d');
		$condition = "data_inicio <= :hoje AND ";
		$condition .= "data_fim >= :hoje ";
		$pessoas = Ferias::model()->findAll($condition, array('hoje'=>$hoje));
		return $pessoas;
	}
	
	public static function findNextVacations(){
			$hoje = date('Y-m-d');
			$condition = "data_inicio > :hoje AND ";
			$condition .= "data_fim > :hoje ";
			$pessoas = Ferias::model()->findAll($condition, array('hoje'=>$hoje));
			return $pessoas;
		}
}