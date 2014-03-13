<?php

/**
 * This is the model class for table "grupo_trabalho".
 *
 * The followings are the available columns in table 'grupo_trabalho':
 * @property string $nome
 * @property string $apresentacao
 * @property integer $cod_coordenador
 * @property integer $cod_gt
 * @property integer $ordem
 * @property boolean $visible
 *
 * The followings are the available model relations:
 * @property Pessoa $coordenador
 * @property Pessoa[] $pessoas
 * @property Projeto[] $projetos
 */
class GrupoTrabalho extends CActiveRecord
{
	
	public $resumo;
	//TODO CEGOV - GrupoTrabalho - Fazer campo "RESUMO"
	/**
	 * Returns the static model of the specified AR class.
	 * @return GrupoTrabalho the static model class
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
		return 'grupo_trabalho';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define	 rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, apresentacao, cod_coordenador', 'required'),
			array('cod_coordenador, ordem', 'numerical', 'integerOnly'=>true),
			array('visible, ordem', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nome, apresentacao, cod_coordenador, cod_gt, ordem', 'safe', 'on'=>'search'),
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
			'coordenador' => array(self::BELONGS_TO, 'Pessoa', 'cod_coordenador'),
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_gt(cod_gt, cod_pessoa)',
							'order'=>'categorias.ordem ASC',
                            'with'=>'categorias'),
			'projetos' => array(self::HAS_MANY, 'Projeto', 'cod_gt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nome' => 'Nome',
			'apresentacao' => 'Apresentacao',
			'coordenador' => 'Coordenador',
			'cod_gt' => 'Cod Gt',
			'cod_coordenador'=>'Coordenador',
			'visible'=>'Visível',
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

		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('apresentacao',$this->apresentacao,true);
		$criteria->compare('coordenador',$this->coordenador);
		$criteria->compare('cod_gt',$this->cod_gt);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
/**
	 * define o escopo padrão do objeto - neste caso, usamos para definir a linguagem padrão
	 * (non-PHPdoc)
	 * @see CActiveRecord::defaultScope()
	 */
	public function defaultScope(){
		
		return array(
			//'alias'=>'gt',
			'condition'=>'lang=:lang',
			'params'=>array(':lang'=>Yii::app()->language),
		);
	}
	
	/**
	 * Seta uma determinada linguagem para os objetos
	 * ex: Publicacao::model()->lang('en')->findAll()
	 * @param $lang
	 */
	public function lang($lang){
		
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'lang=:lang',
			'params'=>array(':lang'=>$lang),
		));
		
		return $this;
	}
	
}