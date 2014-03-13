<?php

/**
 * This is the model class for table "publicacao".
 *
 * The followings are the available columns in table 'publicacao':
 * @property integer $cod_publicacao
 * @property string $titulo
 * @property string $autor
 * @property string $ano
 * @property integer $cod_tipo
 * @property string $descricao
 * @property string $tags
 * @property string $href
 * @property string $detalhamento
 * @property string $file - handler para arquivos
 * @property boolean $pessoal
 *
 * The followings are the available model relations:
 * @property PublicacaoTipo $tipo
 * @property Pessoa[] $pessoas - Autores dentro do cegov.
 */
class Publicacao extends CActiveRecord
{
	
	public  $file;
	public $imageFile;
	public $imageLink;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Publicacao the static model class
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
		return 'publicacao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, autor, ano, descricao, cod_tipo', 'required'),
			array('cod_tipo', 'numerical', 'integerOnly'=>true),
			array('pessoal', 'boolean'),
			array('href, detalhamento, imagem, tags', 'safe'),
			array('file', 'validaArquivos'),
			array('imageFile', 'file',
				 'types'=>'jpg, png, gif', 
				 'allowEmpty'=>true,
				 'tooLarge'	=>"Esta imagem é muito grande. Ele deve ter no máximo 400KB",
				 'maxSize'=> 1024*420 //400kb
					),
			array('file', 'file',
				 'types'=>'pdf, doc, docx, rtf, odt', 
				 'allowEmpty'=>true,
				 //'tooLarge'	=>"Este arquivo é muito grande. Ele deve ter no máximo 20MB",
				 //'maxSize'=> 1024*1024*20 //20MB
					),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_publicacao, href, titulo, autor, ano, file, cod_tipo, descricao', 'safe', 'on'=>'search'),
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
			'tipo' => array(self::BELONGS_TO, 'PublicacaoTipo', 'cod_tipo'),
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_publicacao(cod_publicacao, cod_pessoa)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_publicacao' => Yii::t('publicacao', 'cod_publicacao'),
			'titulo' => Yii::t('Publicacao', 'titulo'),
			'autor' => Yii::t('Publicacao', 'autor'),
			'ano' => Yii::t('Publicacao', 'ano'),
			'file' => Yii::t('Publicacao', 'file'),
			'cod_tipo' => Yii::t('Publicacao', 'cod_tipo'),
			'descricao' => Yii::t('Publicacao', 'descricao'),
			'href'=> Yii::t('Publicacao', 'href'),
			'tipo'=>Yii::t('Publicacao', 'tipo'),
			'imageFile'=>Yii::t('Publicacao', 'imageFile'),
			'tags'=>Yii::t('Publicacao', 'tags'),
			'pessoal'=>Yii::t('Publicacao', 'pessoal'),
			'detalhamento'=>Yii::t('Publicacao', 'detalhamento'),
			'pessoas'=>Yii::t('Publicacao', 'pessoas'),
			'url_externa'=>Yii::t('Publicacao', 'url_externa'),
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

		$criteria->compare('cod_publicacao',$this->cod_publicacao);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('autor',$this->autor,true);
		$criteria->compare('ano',$this->ano,true);
		$criteria->compare('file',$this->file,true);
		$criteria->compare('cod_tipo',$this->cod_tipo);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	/**
	 * 
	 * Enter description here ...
	 * @param unknown_type $attribute
	 * @param unknown_type $params
	 */
	public function validaArquivos($attribute, $params){
			
			$file = CUploadedFile::getInstance($this,'file');
		
			if(($this->href == NULL) &&  ($file == NULL) ){
			 	$this->addError($attribute, 'Você deve especificar um link externo ou fazer upload de um arquivo.');
			}
	}
	
	/**
	 * Funcao executada após recuperacao no banco de dados do modelo
	 * @see CActiveRecord::afterFind()
	 */
	public function afterFind(){
		 $this->imageFile = Yii::getPathOfAlias('webroot.images.pubs') .DIRECTORY_SEPARATOR .$this->imagem ;
		 $this->imageLink = Yii::app()->request->baseUrl .'/images/pubs/' .$this->imagem;
		parent::afterFind();
	}
	
	/**
	 * define o escopo padrão do objeto - neste caso, usamos para definir a linguagem padrão
	 * (non-PHPdoc)
	 * @see CActiveRecord::defaultScope()
	 */
	public function defaultScope(){
		
		return array(
			'alias'=>'pub',
			'condition'=>'pub.lang=:lang',
			'params'=>array(':lang'=>Yii::app()->language),
		);
	}
	
	/**
	 * Seta uma determinada linguagem para os objetos
	 * ex: Publicacao::model()->lang('en')->findAll()
	 * @param $lang
	 */
	public function lang($lang){
		
		$this->getDbCriteria()->mergeWith(array(
			'alias'=>'pub',
			'condition'=>'pub.lang=:lang',
			'params'=>array(':lang'=>$lang),
		));
		
		return $this;
	}
	
}