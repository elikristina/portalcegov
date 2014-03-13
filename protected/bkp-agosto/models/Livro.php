<?php

/**
 * This is the model class for table "livro".
 *
 * The followings are the available columns in table 'livro':
 * @property integer $cod_publicacao
 * @property string $titulo
 * @property string $autor
 * @property string $ano
 * @property string $editora
 * @property string $isbn
 * @property integer $cod_tipo
 * @property string $descricao
 * @property string $href
 * @property string $issn
 *
 * The followings are the available model relations:
 * @property PublicacaoTipo $codTipo
 */
class Livro extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Livro the static model class
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
		return 'livro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, autor, ano, editora, isbn, descricao', 'required'),
			array('cod_tipo', 'numerical', 'integerOnly'=>true),
			array('href, issn', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_publicacao, titulo, autor, ano, editora, isbn, cod_tipo, descricao, href, issn', 'safe', 'on'=>'search'),
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
			'codTipo' => array(self::BELONGS_TO, 'PublicacaoTipo', 'cod_tipo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_publicacao' => 'Cod Publicacao',
			'titulo' => 'Titulo',
			'autor' => 'Autor',
			'ano' => 'Ano',
			'editora' => 'Editora',
			'isbn' => 'Isbn',
			'cod_tipo' => 'Cod Tipo',
			'descricao' => 'Descricao',
			'href' => 'Href',
			'issn' => 'Issn',
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
		$criteria->compare('editora',$this->editora,true);
		$criteria->compare('isbn',$this->isbn,true);
		$criteria->compare('cod_tipo',$this->cod_tipo);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('href',$this->href,true);
		$criteria->compare('issn',$this->issn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}