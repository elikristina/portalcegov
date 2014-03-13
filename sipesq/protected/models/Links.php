<?php

/**
 * This is the model class for table "links".
 *
 * The followings are the available columns in table 'links':
 * @property integer $cod_link
 * @property string $nome
 * @property string $link
 * @property string $descricao
 * @property string $tags
 */
class Links extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Links the static model class
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
		return 'links';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nome, link', 'required'),
			array('tags,descricao', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('nome, link, descricao, tags', 'safe', 'on'=>'search'),
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
			'cod_link' => 'ID',
			'nome' => 'Nome',
			'link' => 'Link',
			'descricao' => 'Descrição',
			'tags' => 'Tags',
		);
	}
	
	
	public static function toArray(){
		$arr = array();
		
		//Coloca os nomes
		$links = Links::model()->findAll();
		foreach($links as $link){
			$arr[] = $link->nome;
			foreach(explode(', ', $link->tags) as $tag){
				if(!in_array($tag,$arr))
				 $arr[] = $tag;
			}
		}
		
		//Coloca as tags
		
		return $arr;
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

		$criteria->compare('cod_link',$this->cod_link);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('tags',$this->tags,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}