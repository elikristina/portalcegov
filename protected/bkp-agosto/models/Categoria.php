<?php

/**
 * This is the model class for table "categoria".
 *
 * The followings are the available columns in table 'categoria':
 * @property integer $cod_categoria
 * @property string $nome
 * @property integer $ordem
 *
 * The followings are the available model relations:
 * @property Pessoa[] $pessoas
 * @property AtividadeCategoria $categoriaPai
 * @property AtividadeCategoria[] $secundarias
 */
class Categoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Categoria the static model class
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
		return 'categoria';
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
			array('ordem', 'numerical', 'integerOnly'=>true),
			array('cod_categoria_pai', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_categoria, nome, ordem', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * 
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_categoria(cod_categoria, cod_pessoa)'),
			'categoriaPai' => array(self::BELONGS_TO, 'Categoria', 'cod_categoria_pai'),
			'secundarias' => array(self::HAS_MANY, 'Categoria', 'cod_categoria_pai', 'order'=>'secundarias.ordem ASC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_categoria' => 'Categoria',
			'nome' => 'Nome',
			'ordem' => 'Ordem',
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

		$criteria->compare('cod_categoria',$this->cod_categoria);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('ordem',$this->ordem);
		$criteria->compare('cod_categoria_pai',$this->cod_categoria_pai);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}