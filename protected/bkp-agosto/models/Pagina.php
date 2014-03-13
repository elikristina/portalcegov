<?php

/**
 * This is the model class for table "pagina".
 *
 * The followings are the available columns in table 'pagina':
 * @property integer $cod_pagina
 * @property string $conteudo
 * @property string $titulo
 * @property string $layout
 *  @property string $tipo
 */
class Pagina extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pagina the static model class
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
		return 'pagina';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('conteudo, titulo', 'required'),
			array('layout', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_pagina, conteudo, titulo, layout', 'safe', 'on'=>'search'),
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
			'cod_pagina' => 'Código da página',
			'conteudo' => 'Conteúdo',
			'titulo' => 'Título',
			'layout' => 'Layout',
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
		
		//Este critério possibilita editar excluir somente serviços e não paginas do sistema
		$criteria->condition = "tipo = 'serviço'";
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->order = "titulo";

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public static function getMenuServicos(){
		//Carrega o submenu de pesquisadores
	$servicos = Pagina::model()->findALL(array('order'=>'titulo', 'condition'=>"tipo = 'serviço'"));
	$menuServicos = array();
	$itemServico = array();
	
		for($i=0;$i<count($servicos);$i++){
			$itemServico["label"] = $servicos[$i]->titulo;
			$itemServico["url"] = array("/pagina/" .$servicos[$i]->cod_pagina); 
			$menuServicos[] = $itemServico;
		}
		
	return $menuServicos;
		
	}
}