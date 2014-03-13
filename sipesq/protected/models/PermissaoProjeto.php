<?php

/**
 * This is the model class for table "permissao_projeto".
 *
 * The followings are the available columns in table 'permissao_projeto':
 * @property integer $cod_projeto
 * @property integer $cod_pessoa
 * @property integer $nivel_permissao
 * 
 *  The followings are the available model relations:
 * @property Pessoa $pessoa
 * @property Projeto $projeto
 */
class PermissaoProjeto extends CActiveRecord
{
	const DENIED_PERMITION = 0;
	const READ_PERMITION = 1;
	const READ_WRITE_PERMITION = 2;
	const READ_WRITE_DELETE_PERMITION = 100;
	
	
	public $nivel;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return PermissaoProjeto the static model class
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
		return 'permissao_projeto';
	}
	
	public static function listPermitionData(){
		return array(
				//self::DENIED_PERMITION => 'Permissão Negada',
				self::DENIED_PERMITION => 'Acesso Negado',
				self::READ_PERMITION => 'Leitura',
				self::READ_WRITE_PERMITION => 'Leitura/Escrita',
				self::READ_WRITE_DELETE_PERMITION => 'Administrador',
		);
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cod_projeto, cod_pessoa, nivel_permissao', 'required'),
			array('cod_projeto, cod_pessoa, nivel_permissao', 'numerical', 'integerOnly'=>true),
			array('cod_pessoa', 'validaPessoa'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_projeto, cod_pessoa, nivel_permissao', 'safe', 'on'=>'search'),
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
			'pessoa' => array(self::BELONGS_TO, 'Pessoa', 'cod_pessoa'),
			'projeto' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_projeto' => 'Projeto',
			'cod_pessoa' => 'Pessoa',
			'nivel_permissao' => 'Permissão',
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
		$criteria->compare('nivel_permissao',$this->nivel_permissao);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function afterFind(){
		
		switch ($this->nivel_permissao){
			case Sipesq::USER_PERMITION: 
				$this->nivel = "Usuário";
				break;
			case Sipesq::SUPPORT_PERMITION:  
				$this->nivel = "Apoio Técnico";
				break;
			case Sipesq::ADMIN_PERMITION: 
				$this->nivel = "Responsável";
				break;
			case Sipesq::READ_WRITE_PERMITION:
				$this->nivel = "Leitura e Escrita";
				break;
		}
		
		parent::afterFind();
	}
	
	
	public function validaPessoa($attribute,$params){
			//	Se ja tem algum erro nem valida
			if($this->hasErrors())
			  return false;
			 
			$perm = $this->find('cod_pessoa = :cod_pessoa AND cod_projeto = :cod_projeto', array('cod_projeto'=>$this->cod_projeto, 'cod_pessoa'=>$this->cod_pessoa));
			
			 if($perm != null && $this->isNewRecord)
					 	$this->addError($attribute, 'Esta pessoa já tem permissões neste projeto.');
		
	}

	public static function load($data){
		$perm = new PermissaoProjeto();
		foreach($data as $key=>$val) $perm->$key = $val;
		return $perm;
	}
}