<?php

/**
 * This is the model class for table "projeto_arquivo".
 *
 * The followings are the available columns in table 'projeto_arquivo':
 * @property integer $cod_arquivo
 * @property integer $cod_projeto
 * @property string $href
 * @property string $nome
 * @property string $descricao
 * @property string $filename
 * @property string $data_inclusao
 *
 * The followings are the available model relations:
 * @property Projeto $codProjeto
 */
class ProjetoArquivo extends CActiveRecord
{
	public $file;
		
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ProjetoArquivo the static model class
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
		return 'projeto_arquivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_projeto, nome', 'required'),
			array('cod_projeto', 'numerical', 'integerOnly'=>true),
			array('descricao, data_inclusao, size, type, extensionName', 'safe'),
			array('file', 'file',
				 'allowEmpty'=>!$this->isNewRecord,
				 'maxSize'=>1024*1024*20,
					),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nome', 'safe', 'on'=>'search'),
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
			'projeto' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_arquivo' => 'ID',
			'cod_projeto' => 'Projeto',
			'href' => 'Href',
			'nome' => 'Nome',
			'descricao' => 'Descrição',
			'data_inclusao' => 'Data de Inclusão',
			'file'=>'Arquivo',
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

		$criteria->compare('cod_arquivo',$this->cod_arquivo);
		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('descricao',$this->descricao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}