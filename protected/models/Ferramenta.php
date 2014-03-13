<?php

/**
 * This is the model class for table "ferramenta".
 *
 * The followings are the available columns in table 'ferramenta':
 * @property integer $cod_ferramenta
 * @property string $nome_completo
 * @property string $nome_abreviado
 * @property string $texto
 * @property string $imagem
 */
class Ferramenta extends CActiveRecord
{

	public $imageFile;
	public $imageLink;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Ferramenta the static model class
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
		return 'ferramenta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome_completo, nome_abreviado, texto, imagem, link', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_ferramenta, nome_completo, nome_abreviado, texto, imagem', 'safe', 'on'=>'search'),
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
			'cod_ferramenta' => 'Cod Ferramenta',
			'nome_completo' => 'Nome Completo',
			'nome_abreviado' => 'Nome Abreviado',
			'texto' => 'Texto',
			'imagem' => 'Imagem',
			'link' => 'Link'
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

		$criteria->compare('cod_ferramenta',$this->cod_ferramenta);
		$criteria->compare('nome_completo',$this->nome_completo,true);
		$criteria->compare('nome_abreviado',$this->nome_abreviado,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('imagem',$this->imagem,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function afterFind(){
		 $this->imageFile = Yii::getPathOfAlias('webroot.images.ferramentas') .DIRECTORY_SEPARATOR .$this->imagem ;
		 $this->imageLink = Yii::app()->request->baseUrl .'/images/ferramentas/' .$this->imagem;
		parent::afterFind();
	}
}