<?php

/**
 * This is the model class for table "publicacao_tipo".
 *
 * The followings are the available columns in table 'publicacao_tipo':
 * @property integer $cod_tipo
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property Publicacao[] $publicacoes
 * @property Publicacao[] $publicacoes_cegov
 */
class PublicacaoTipo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PublicacaoTipo the static model class
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
		return 'publicacao_tipo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, nome_en, template', 'required'),
			array('nome, nome_en, template', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_tipo, nome', 'safe', 'on'=>'search'),
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
			'publicacoes' => array(self::HAS_MANY, 'Publicacao', 'cod_tipo', 'select'=>'cod_publicacao, titulo, autor'),
			'publicacoes_cegov' => array(self::HAS_MANY, 'Publicacao', 'cod_tipo', 'condition'=>'pessoal = false', 'select'=>'cod_publicacao, titulo, autor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_tipo' => 'ID',
			'nome' => 'Nome',
			'template' => "Template",
			'template_citacao' => 'Template para Citação',
			'pub_tipo_lan' => 'Linguagem da Publicação',
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

		$criteria->compare('cod_tipo',$this->cod_tipo);
		$criteria->compare('nome',$this->nome,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	/**
	 * Aplica a lingagem atual ao modelo
	 * @see db/ar/CActiveRecord::defaultScope()
	 
	public function defaultScope(){
		return array(
			'condition'=>'publicacao_tipo_lang = :lang',
			'params'=>array(':lang'=>Yii::app()->language)
		);
	}
	*/ 
	
	/**
	 * Aplica a linguagem por meio do parâmetro passado
	 * @param string $lang
	 
	public function lang($lang){
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'publicacao_tipo_lang = :lang',
			'params'=>array(':lang'=>$lang)
		));
	} */
	
/**
	 * (non-PHPdoc)
	 * @see db/ar/CActiveRecord::beforeSave()
	
	public function beforeValidate(){
		$this->publicacao_tipo_lang = Yii::app()->language;
		parent::beforeValidate();
		return true;
	}  */
	
	
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