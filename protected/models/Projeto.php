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
 * @property string $projeto_lang
 * @property string $nome_en
 * @property string $subtitulo_en
 * @property string $texto_en
 * @property string $status_en
 * @property string $coordenador
 * 
 *
 * The followings are the available model relations:
 * @property GrupoTrabalho $gt
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
			array('subtitulo, tipo_ajuda, nome_en, subtitulo_en, texto_en, status_en, financiador_en, coordenador', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_projeto, nome, subtitulo, texto, data_inicio, data_fim, financiador, status, tipo_ajuda, cod_gt, projeto_lang, nome_en, subtitulo_en, texto_en, status_en, coordenador', 'safe', 'on'=>'search'),
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
			'gt' => array(self::BELONGS_TO, 'GrupoTrabalho', 'cod_gt', 'select'=>'cod_gt, nome, nome_en'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_projeto' => Yii::t('Projeto', 'cod_projeto'),
			'nome' => Yii::t('Projeto', 'nome'),
			'subtitulo' => Yii::t('Projeto', 'subtitulo'),
			'texto' => Yii::t('Projeto', 'texto'),
			'data_inicio' => Yii::t('Projeto', 'data_inicio'),
			'data_fim' => Yii::t('Projeto', 'data_fim'),
			'financiador' => Yii::t('Projeto', 'financiador'),
			'status' => Yii::t('Projeto', 'status'),
			'tipo_ajuda' => Yii::t('Projeto', 'tipo_ajuda'),
			'cod_gt' => Yii::t('Projeto', 'cod_gt'),
			'projeto_lang' => 'Projeto Lang',
			'nome_en' => Yii::t('Projeto', 'nome'),
			'subtitulo_en' => Yii::t('Projeto', 'subtitulo'),
			'texto_en' => Yii::t('Projeto', 'texto'),
			'status_en' => Yii::t('Projeto', 'status'),
			'coordenador' => Yii::t('Projeto', 'status'),
			'financiador_en' => Yii::t('Projeto', 'financiador'),
		
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
		$criteria->compare('projeto_lang',$this->projeto_lang,true);
		$criteria->compare('nome_en',$this->nome_en,true);
		$criteria->compare('subtitulo_en',$this->subtitulo_en,true);
		$criteria->compare('texto_en',$this->texto_en,true);
		$criteria->compare('status_en',$this->status_en,true);
		$criteria->compare('coordenador',$this->coordenador,true);
		$criteria->compare('financiador_en',$this->financiador_en,true);
		

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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