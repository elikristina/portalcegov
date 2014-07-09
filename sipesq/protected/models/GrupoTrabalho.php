<?php

/**
 * This is the model class for table "grupo_trabalho".
 *
 * The followings are the available columns in table 'grupo_trabalho':
 * @property string $nome
 * @property string $nome_en
 * @property string $apresentacao
 * @property string $apresentacao_en
 * @property integer $cod_coordenador
 * @property integer $cod_pos_responsavel
 * @property integer $cod_gt
 * @property integer $ordem
 * @property boolean $visible
 *
 * The followings are the available model relations:
 * @property Pessoa $coordenador
 * @property Pessoa $pos_responsavel
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
			array('nome, apresentacao, nome_en, apresentacao_en cod_coordenador', 'required'),
			array('cod_coordenador,cod_pos_responsavel, ordem', 'numerical', 'integerOnly'=>true),
			array('visible, ordem, media', 'safe'),
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
			'coordenador' => array(self::BELONGS_TO, 'Pessoa', 'cod_coordenador', 'select'=>'cod_pessoa, nome, imagem, email'),
			'pos_responsavel' => array(self::BELONGS_TO, 'Pessoa', 'cod_pos_responsavel', 'select'=>'cod_pessoa, nome, email, imagem'),
			'pessoas' => array(self::MANY_MANY, 'Pessoa', 'pessoa_gt(cod_gt, cod_pessoa)',
							'order'=>'pessoas.nome ASC, categorias.ordem ASC',
                            'with'=>'categorias',
                            'select'=>'cod_pessoa, nome, imagem, email'
		
			),
			'projetos' => array(self::HAS_MANY, 'Projeto', 'cod_gt'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'nome' => Yii::t('GrupoTrabalho', 'nome'),
			'apresentacao' => Yii::t('GrupoTrabalho', 'apresentacao'),
			'coordenador' => Yii::t('GrupoTrabalho', 'coordenador'),
			'cod_gt' => Yii::t('GrupoTrabalho', 'cod_gt'),
			'cod_coordenador'=>Yii::t('GrupoTrabalho', 'cod_coordenador'),
			'visible'=>Yii::t('GrupoTrabalho', 'visivel'),
			'cod_pos_responsavel'=>Yii::t('GrupoTrabalho', 'cod_pos_responsavel'),
			'pos_responsavel'=>Yii::t('GrupoTrabalho', 'cod_pos_responsavel'),
			'media'=>Yii::t('GrupoTrabalho', 'media'),
		
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
	 * 
	 * Retorna todos os usuários permitidos para alterar um GT
	 * @param integer $id - Identificador do Grupo de Trabalho
	 * @return array - usuarios cadastrados
	 */
	public function getPermited(){
		
		$permited = array();
		//Admin
		$permited[] = 'admin';
		
		//Coordenador
		if(isset($this->coordenador))
			$permited[] = $this->coordenador->email;
		
		//Pós Graduando responsável
		if(isset($this->pos_responsavel))
			$permited[] = $this->pos_responsavel->email;
			
		return $permited;
	}
	
/**
	 * 
	 * Traduz o parametro $p para a lingua da aplicacao
	 * @param $p
	 */
	public function t($p){

		if(Yii::app()->language == 'en'){
			$parm = $p .'_' .Yii::app()->language;
			return $this->$parm;	
		}
		
		return $this->$p;
	}
	
	
}