<?php

/**
 * This is the model class for table "atividade_passo".
 *
 * The followings are the available columns in table 'atividade_passo':
 * @property integer $cod_passo
 * @property integer $cod_pessoa
 * @property integer $cod_atividade
 * @property string $descricao
 * @property string $data_criacao
 * @property string $data_finalizacao
 * @property boolean $finalizado
 * @property string $data_prazo
 *
 * The followings are the available model relations:
 * @property Atividade $atividade
 * @property Pessoa $pessoa
 */
class AtividadePasso extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AtividadePasso the static model class
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
		return 'atividade_passo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_pessoa, cod_atividade, descricao, data_criacao, data_prazo', 'required'),
			array('cod_pessoa, cod_atividade', 'numerical', 'integerOnly'=>true),
			array('data_criacao, data_finalizacao', 'length', 'max'=>10),
			array('finalizado', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_passo, cod_pessoa, cod_atividade, descricao, data_criacao, data_finalizacao, finalizado', 'safe', 'on'=>'search'),
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
			'atividade' => array(self::BELONGS_TO, 'Atividade', 'cod_atividade'),
			'pessoa' => array(self::BELONGS_TO, 'Pessoa', 'cod_pessoa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_passo' => 'Passo',
			'cod_pessoa' => 'Pessoa',
			'cod_atividade' => 'Atividade',
			'descricao' => 'Descrição',
			'data_criacao' => 'Data Criação',
			'data_finalizacao' => 'Data Finalização',
			'finalizado' => 'Finalizado',
			'data_prazo'=>'Prazo',
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

		$criteria->compare('cod_passo',$this->cod_passo);
		$criteria->compare('cod_pessoa',$this->cod_pessoa);
		$criteria->compare('cod_atividade',$this->cod_atividade);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('data_criacao',$this->data_criacao,true);
		$criteria->compare('data_finalizacao',$this->data_finalizacao,true);
		$criteria->compare('finalizado',$this->finalizado);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	/**
	 * Verifica se o usuario eh responsavel por esta atividade
	 * @param integer $id - Identificador do usuario
	 */
	public function isResponsible($id){
		return ($this->cod_pessoa == $id);
	}
}