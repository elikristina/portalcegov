<?php

/**
 * This is the model class for table "contato".
 *
 * The followings are the available columns in table 'contato':
 * @property integer $cod_contato
 * @property string $nome
 * @property string $telefone
 * @property string $email
 * @property string $website
 * @property string $endereco
 * @property string $instituicao
 * @property string $descricao
 */
class Contato extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Contato the static model class
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
		return 'contato';
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
			array('telefone, email, website, endereco, instituicao, descricao', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_contato, nome, telefone, email, website, endereco, instituicao, descricao', 'safe', 'on'=>'search'),
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
			'cod_contato' => 'ID',
			'nome' => 'Nome',
			'telefone' => 'Telefone',
			'email' => 'Email',
			'website' => 'Website',
			'endereco' => 'Endereço',
			'instituicao' => 'Instituição',
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

		$criteria->compare('cod_contato',$this->cod_contato);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('telefone',$this->telefone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('endereco',$this->endereco,true);
		$criteria->compare('instituicao',$this->instituicao,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}