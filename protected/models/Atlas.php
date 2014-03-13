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
class Atlas extends CActiveRecord
{
	public $imageFile;
	public $imageLink;
	
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
		return 'atlas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('titulo, pais, local, latitude, longitude, descricao', 'required'),
			array('latitude, longitude', 'numerical'),
			array('imageFile', 'file',
				 'types'=>'jpg, png, gif', 
				 'allowEmpty'=>true,
				 'tooLarge'	=>"Este arquivo é muito grande. Ele deve ter no máximo 400KB",
				 'maxSize'=> 1024*420 //400kb
					),
			array('organizacao, data_inicio, data_fim, marcador', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, titulo, organizacao, pais, local, latitude, longitude, data_inicio, data_fim, marcador, descricao', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'titulo' => 'Título',
			'organizacao' => 'Organização',
			'pais' => 'País',
			'local' => 'Local',
			'latitude' => 'Latitude',
			'longitude' => 'Longitude',
			'data_inicio' => 'Data de Início',
			'data_fim' => 'Data de Fim',
			'marcador' => 'Marcador',
			'descricao' => 'Descrição',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('organizacao',$this->organizacao,true);
		$criteria->compare('pais',$this->pais,true);
		$criteria->compare('local',$this->local,true);
		$criteria->compare('latitude',$this->latitude);
		$criteria->compare('longitude',$this->longitude);
		$criteria->compare('data_inicio',$this->data_inicio,true);
		$criteria->compare('data_fim',$this->data_fim,true);
		$criteria->compare('marcador',$this->marcador,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind(){
		//Atualiza os arquivos de imagem dos marcadores
		 $this->imageFile = Yii::getPathOfAlias('application.data.markers') .DIRECTORY_SEPARATOR .$this->marcador;
		 $this->imageLink = Yii::app()->request->baseUrl .'/protected/data/markers/' .$this->marcador;
		parent::beforeSave();
	}
}