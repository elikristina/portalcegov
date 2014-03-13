<?php

/**
 * This is the model class for table "new".
 *
 * The followings are the available columns in table 'new':
 * @property integer $cod_noticia
 * @property string $titulo
 * @property string $texto
 * @property string $data_postagem
 * @property string $autor
 * @property boolean $eh_evento
 */
class Noticia extends CActiveRecord
{
	public $imageFile;
	public $imageLink;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Noticia the static model class
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
		return 'noticia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, titulo_en, data_postagem, autor', 'required'),
			array('texto, texto_en, eh_evento, eh_cursoppa, imagem', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('imageFile', 'file',
				 'types'=>'jpg, png, gif', 
				 'allowEmpty'=>true,
				 'tooLarge'	=>"Este arquivo é muito grande. Ele deve ter no máximo 400KB",
				 'maxSize'=> 1024*420 //400kb
					),
			array('cod_noticia, titulo, texto, data_postagem, autor, eh_evento', 'safe', 'on'=>'search'),
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
			'cod_noticia' => 'ID',
			'titulo' => 'Título',
			'texto' => 'Texto',
			'data_postagem' => 'Data de Postagem',
			'autor' => 'Autor',
			'eh_evento' => 'É Evento',
			'eh_cursoppa' => 'Curso PPA',
			'imagem' => Yii::t('Noticia', 'imagem'),
			'imageFile'=>Yii::t('Noticia', 'imageFile'),
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

		$criteria->compare('cod_noticia',$this->cod_noticia);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('data_postagem',$this->data_postagem,true);
		$criteria->compare('autor',$this->autor,true);
		$criteria->compare('eh_evento',$this->eh_evento);
		$criteria->compare('eh_cursoppa',$this->eh_cursoppa);
		$criteria->compare('imagem',$this->imagem, true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind(){
		 $this->imageFile = Yii::getPathOfAlias('webroot.images.carousel') .DIRECTORY_SEPARATOR .$this->imagem ;
		 $this->imageLink = Yii::app()->request->baseUrl .'/images/carousel/' .$this->imagem;
		parent::afterFind();
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
	
	/**
	 * Aplica a lingagem atual ao modelo
	 * @see db/ar/CActiveRecord::defaultScope()
	public function defaultScope(){
		return array(
			'condition'=>'noticia_lang = :lang',
			'params'=>array(':lang'=>Yii::app()->language)
		);
	}
	
	/**
	 * Aplica a linguagem por meio do parâmetro passado
	 * @param string $lang
	public function lang($lang){
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'noticia_lang = :lang',
			'params'=>array(':lang'=>$lang)
		));
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see db/ar/CActiveRecord::beforeSave()
	 
	public function beforeValidate(){
		$this->noticia_lang = Yii::app()->language;
		parent::beforeValidate();
		return true;
	}
	*/
}