<?php

/**
 * This is the model class for table "grupo".
 *
 * The followings are the available columns in table 'grupo':
 * @property integer $cod_grupo
 * @property string $permissao
 * @property string $descricao
 * @property string $nome
 *
 * The followings are the available model relations:
 * @property Pessoa[] $pessoas
 */
class Grupo extends CActiveRecord
{
	const DENIED_PERMITION = 0;
	const READ_PERMITION = 1;
	const READ_WRITE_PERMITION = 2;
	const READ_WRITE_DELETE_PERMITION = 100;
	
	public	$atividade
		,	$pessoa
		,	$projeto
		, 	$gerencial
		,	$acervo;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Grupo the static model class
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
		return 'grupo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('permissao, descricao, nome', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_grupo, permissao, descricao, nome', 'safe', 'on'=>'search'),
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
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_grupo(cod_grupo, cod_pessoa)', 'order'=>'pessoas.nome'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_grupo' => 'Cod Grupo',
			'permissao' => 'Permissao',
			'descricao' => 'Descrição do Grupo',
			'pessoas'=>'Pessoas do Grupo',
			'nome'=>'Nome do Grupo',
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

		$criteria->compare('cod_grupo',$this->cod_grupo);
		$criteria->compare('permissao',$this->permissao,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function defaultPermitions(){
		return array(
				//self::DENIED_PERMITION => 'Permissão Negada',
				self::DENIED_PERMITION => 'Acesso Negado',
				self::READ_PERMITION => 'Leitura',
				self::READ_WRITE_PERMITION => 'Leitura e Edição',
				self::READ_WRITE_DELETE_PERMITION => 'Leitura, Edição e Exclusão',
		);
	}
	
	public static function binaryPermitions(){
		return array(
				//self::DENIED_PERMITION => 'Permissão Negada',
				self::DENIED_PERMITION => 'Acesso Negado',
				self::READ_WRITE_DELETE_PERMITION => 'Permitido',
		);
	}
}