<?php

/**
 * This is the model class for table "atividade_categoria".
 *
 * The followings are the available columns in table 'atividade_categoria':
 * @property integer $cod_categoria
 * @property integer $cod_categoria_pai
 * @property string $nome
 * @property string $texto_finalizado
 * @property string $texto_andamento
 * @property string $descricao_relatorio
 * @property string $descricao_adicional
 *
 * The followings are the available model relations:
 * @property AtividadeCategoria $categoriaPai
 * @property AtividadeCategoria[] $secundarias
 */
class AtividadeCategoria extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return AtividadeCategoria the static model class
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
		return 'atividade_categoria';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, descricao_relatorio', 'required'),
			array('cod_categoria_pai', 'numerical', 'integerOnly'=>true),
			array('texto_finalizado, texto_andamento, descricao_adicional', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_categoria, cod_categoria_pai, nome, texto_finalizado, texto_andamento, descricao_relatorio, descricao_adicional', 'safe', 'on'=>'search'),
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
			'categoriaPai' => array(self::BELONGS_TO, 'AtividadeCategoria', 'cod_categoria_pai'),
			'secundarias' => array(self::HAS_MANY, 'AtividadeCategoria', 'cod_categoria_pai'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_categoria' => 'Cod Categoria',
			'cod_categoria_pai' => 'Cod Categoria Pai',
			'nome' => 'Nome',
			'texto_finalizado' => 'Texto Finalizado',
			'texto_andamento' => 'Texto Andamento',
			'descricao_relatorio' => 'Descricao Relatorio',
			'descricao_adicional' => 'Descricao Adicional',
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

		$criteria->compare('cod_categoria',$this->cod_categoria);
		$criteria->compare('cod_categoria_pai',$this->cod_categoria_pai);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('texto_finalizado',$this->texto_finalizado,true);
		$criteria->compare('texto_andamento',$this->texto_andamento,true);
		$criteria->compare('descricao_relatorio',$this->descricao_relatorio,true);
		$criteria->compare('descricao_adicional',$this->descricao_adicional,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}