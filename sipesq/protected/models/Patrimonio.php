<?php

/**
 * This is the model class for table "patrimonio".
 *
 * The followings are the available columns in table 'patrimonio':
 * @property integer $cod_patrimonio
 * @property integer $cod_projeto_despesa
 * @property string $nome
 * @property string $nro_patrimonio
 * @property double $valor
 * @property string $descricao
 * @property string $localizacao
 * @property string $data_criacao
 * @property string $data_edicao
 * @property string $criador
 * @property string $editor
 * @property string $logs
 */
class Patrimonio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Patrimonio the static model class
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
		return 'patrimonio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, nro_patrimonio, data_criacao, data_edicao, criador, editor', 'required'),
			array('cod_projeto_despesa', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			array('descricao, localizacao', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_patrimonio, cod_projeto_despesa, nome, nro_patrimonio, valor, descricao, localizacao', 'safe', 'on'=>'search'),
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
			'despesa' => array(self::BELONGS_TO, 'ProjetoDespesa', 'cod_projeto_despesa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_patrimonio' => 'ID',
			'cod_projeto_despesa' => 'Despesa',
			'nome' => 'Nome',
			'nro_patrimonio' => 'Número do Patrimônio',
			'valor' => 'Valor',
			'descricao' => 'Descrição',
			'localizacao' => 'Localização',
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

		$criteria->compare('cod_patrimonio',$this->cod_patrimonio);
		$criteria->compare('cod_projeto_despesa',$this->cod_projeto_despesa);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('nro_patrimonio',$this->nro_patrimonio,true);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('localizacao',$this->localizacao,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	/**
	 * Grava um log de uma ação
	 * @param string $action
	 */
	public function log($action){
	
		$log = "<li>" .date('d/m/Y') ." - " .$action ." - " .Yii::app()->user->name ."</li>";
		$this->logs .= $log;
		return $this->save();
			
	}
	
	
	/**
	 * (non-PHPdoc)
	 * @see CActiveRecord::beforeSave()
	 */
	public function beforeValidate(){
		
		if($this->isNewRecord){
			//Grava dados da criacao
			$this->data_criacao = date('Y-m-d');
			$this->criador = Yii::app()->user->name;
			$this->logs = '';
		}
		
		
		//Grava dados da edicao
		$this->data_edicao = date('Y-m-d');
		$this->editor = Yii::app()->user->name;
		
		return true;
		
	}
	
	
}