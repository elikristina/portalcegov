<?php

/**
 * This is the model class for table "projeto".
 *
 * The followings are the available columns in table 'projeto':
 * @property integer $cod_projeto
 * @property string $nome
 * @property string $subtitulo
 * @property string $texto
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $financiador
 * @property string $status
 * @property string $tipo_ajuda
 * @property integer $cod_gt
 *
 * The followings are the available model relations:
 * @property GrupoTrabalho $codGt
 */
class Projeto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Projeto the static model class
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
		return 'projeto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, texto, data_inicio, data_fim, financiador, status, cod_gt', 'required'),
			array('cod_gt', 'numerical', 'integerOnly'=>true),
			array('subtitulo, tipo_ajuda', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_projeto, nome, subtitulo, texto, data_inicio, data_fim, financiador, status, tipo_ajuda, cod_gt', 'safe', 'on'=>'search'),
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
			'codGt' => array(self::BELONGS_TO, 'GrupoTrabalho', 'cod_gt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_projeto' => 'Cod Projeto',
			'nome' => 'Nome',
			'subtitulo' => 'Subtitulo',
			'texto' => 'Texto',
			'data_inicio' => 'Data Inicio',
			'data_fim' => 'Data Fim',
			'financiador' => 'Financiador',
			'status' => 'Status',
			'tipo_ajuda' => 'Tipo Ajuda',
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

		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('subtitulo',$this->subtitulo,true);
		$criteria->compare('texto',$this->texto,true);
		$criteria->compare('data_inicio',$this->data_inicio,true);
		$criteria->compare('data_fim',$this->data_fim,true);
		$criteria->compare('financiador',$this->financiador,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('tipo_ajuda',$this->tipo_ajuda,true);
		$criteria->compare('cod_gt',$this->cod_gt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}