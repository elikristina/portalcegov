<?php

/**
 * This is the model class for table "projeto_permissao_pessoa".
 *
 * The followings are the available columns in table 'projeto_permissao_pessoa':
 * @property integer $cod_projeto
 * @property integer $cod_pessoa
 * @property string $permissao
 */
class ProjetoPermissaoPessoa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoPermissaoPessoa the static model class
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
		return 'projeto_permissao_pessoa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_projeto, cod_pessoa, permissao', 'required'),
			array('cod_projeto, cod_pessoa', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_projeto, cod_pessoa, permissao', 'safe', 'on'=>'search'),
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
			'cod_projeto' => 'Cod Projeto',
			'cod_pessoa' => 'Cod Pessoa',
			'permissao' => 'Permissao',
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
		$criteria->compare('cod_pessoa',$this->cod_pessoa);
		$criteria->compare('permissao',$this->permissao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}