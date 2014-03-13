<?php

/**
 * This is the model class for table "atlas".
 *
 * The followings are the available columns in table 'atlas':
 * @property integer $id
 * @property string $titulo
 * @property string $organizacao
 * @property string $pais
 * @property string $local
 * @property double $latitude
 * @property double $longitude
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $marcador
 * @property string $descricao
 */
class Curso extends CActiveRecord
{

	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Atlas the static model class
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
			array('texto, texto_en, eh_evento', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
}