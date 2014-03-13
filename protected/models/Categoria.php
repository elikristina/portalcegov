<?php

/**
 * This is the model class for table "categoria".
 *
 * The followings are the available columns in table 'categoria':
 * @property integer $cod_categoria
 * @property string $nome
 * @property string $nome_en
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
			array('nome, nome_en', 'required'),
			array('ordem', 'numerical', 'integerOnly'=>true),
			array('cod_categoria_pai', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_categoria, nome, nome_en ordem', 'safe', 'on'=>'search'),
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
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_categoria(cod_categoria, cod_pessoa)', 'select'=>'cod_pessoa, nome, imagem'),
			'categoriaPai' => array(self::BELONGS_TO, 'Categoria', 'cod_categoria_pai', 'select'=>'cod_categoria, nome, nome_en'),
			'secundarias' => array(self::HAS_MANY, 'Categoria', 'cod_categoria_pai', 'order'=>'secundarias.ordem ASC', 'select'=>'cod_categoria, nome, nome_en'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_categoria' => Yii::t('Categoria', 'cod_categoria'),
			'nome' => Yii::t('Categoria', 'nome'),
			'ordem' => Yii::t('Categoria', 'ordem'),
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
	
	
	/**
	 * Aplica a lingagem atual ao modelo
	 * @see db/ar/CActiveRecord::defaultScope()
	 
	public function defaultScope(){
		return array(
			'condition'=>'categoria_lang = :lang',
			'params'=>array(':lang'=>Yii::app()->language)
		);
	}
	
	/**
	 * Aplica a linguagem por meio do parâmetro passado
	 * @param string $lang
	public function lang($lang){
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'categoria_lang = :lang',
			'params'=>array(':lang'=>$lang)
		));
	}
	
/**
	 * (non-PHPdoc)
	 * @see db/ar/CActiveRecord::beforeSave()
	 */
	public function beforeValidate(){
		$this->categoria_lang = Yii::app()->language;
		parent::beforeValidate();
		return true;
	}
	
	
	/**
	 * 
	 * Traduz o parametro $p para a lingua da aplicacao
	 * @param $p
	 */
	public function t($p){

		if(Yii::app()->language == 'en'){
			$parm = $p .'_' .Yii::app()->language;
			return $this->$parm;	
		}
		
		return $this->$p;
	}
}