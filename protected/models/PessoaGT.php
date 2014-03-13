<?php

/**
 * This is the model class for table "pessoa_gt".
 *
 * The followings are the available columns in table 'pessoa_gt':
 * @property integer $cod_pessoa
 * @property integer $cod_gt
 */
class PessoaGT extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PessoaGT the static model class
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
		return 'pessoa_gt';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, cod_gt', 'required'),
			array('cod_pessoa, cod_gt', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_pessoa, cod_gt', 'safe', 'on'=>'search'),
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
			'cod_gt' => 'Cod Gt',
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
		$criteria->compare('cod_gt',$this->cod_gt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Aplica a lingagem atual ao modelo
	 * @see db/ar/CActiveRecord::defaultScope()
	 */
	public function defaultScope(){
		return array(
			'condition'=>'pessoa_gt_lang = :lang',
			'params'=>array(':lang'=>Yii::app()->language)
		);
	}
	
	/**
	 * Aplica a linguagem por meio do parâmetro passado
	 * @param string $lang
	 */
	public function lang($lang){
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'pessoa_gt_lang = :lang',
			'params'=>array(':lang'=>$lang)
		));
	}
	
	/**
	 * (non-PHPdoc)
	 * @see db/ar/CActiveRecord::beforeSave()
	 */
	public function beforeValidate(){
		$this->pessoa_gt_lang = Yii::app()->language;
		parent::beforeValidate();
		return true;
	}
}