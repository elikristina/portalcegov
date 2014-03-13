<?php
//require_once 'protected/vendors/Zend/Loader.php';
//Yii::import('application.vendors.*');
//Yii::import('zii.widgets.CPortlet');
//require_once 'protected/vendors/Loader.php';
///require_once 'protected/vendors/Zend/Loader/Autoloader.php';
//spl_autoload_unregister(array('YiiBase','autoload'));
//spl_autoload_register(array('Zend_Loader_Autoloader','autoload'));
//spl_autoload_register(array('YiiBase','autoload'));
//Zend_Loader::loadClass('Zend_Gdata_Books');
/**
 * This is the model class for table "livro".
 *
 * The followings are the available columns in table 'livro':
 * @property integer $cod_livro
 * @property string $autor
 * @property integer $ano
 * @property string $titulo
 * @property string $subtitulo
 * @property string $editora
 * @property string $cidade_publicacao
 * @property string $nro_edicao
 * @property integer $nro_patrimonio
 * @property integer $cod_projeto
 * @property integer $volume
 * @property double $valor
 * @property string $local_compra
 * @property string $nro_nota_fiscal
 * @property string $isbn
 * @property integer $nro_exemplares
 * @property string $nro_paginas
 * @property string $localizacao_sabi
 *
 * The followings are the available model relations:
 * @property Projeto $projeto
 */
class Livro extends CActiveRecord
{
	public $assunto;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Livro the static model class
	 */
	public $titulo_abnt;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'livro';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('autor, ano, titulo, editora, cidade_publicacao, nro_edicao, cod_projeto, nro_paginas, nro_exemplares', 'required'),
			array('nro_patrimonio, nro_exemplares, cod_projeto, ano, volume', 'numerical', 'integerOnly'=>true),
			array('valor', 'numerical'),
			array('ano', 'length', 'max'=>4),
			array('ano', 'numerical', 'min'=>1900),
			array('volume', 'length', 'max'=>2),
			array('volume', 'numerical', 'min'=>1),
			array('subtitulo, local_compra, nro_nota_fiscal, isbn, localizacao_sabi, volume', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_livro, autor, ano, titulo, subtitulo, editora, cidade_publicacao, nro_edicao, nro_patrimonio, cod_projeto, valor, local_compra, nro_nota_fiscal, isbn', 'safe', 'on'=>'search'),
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
			'projeto' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto', 'select'=>'cod_projeto, nome'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cod_livro' => 'ID',
			'autor' => 'Autor(es)',
			'ano' => 'Ano',
			'titulo' => 'Título',
			'subtitulo' => 'Subtítulo',
			'editora' => 'Editora',
			'cidade_publicacao' => 'Local da Publicação',
			'nro_edicao' => 'Número da Edição',
			'nro_patrimonio' => 'Número do Patrimônio',
			'cod_projeto' => 'Projeto',
			'valor' => 'Valor',
			'local_compra' => 'Local da Compra',
			'nro_nota_fiscal' => 'Nota Fiscal',
			'isbn' => 'ISBN',
			'titulo_abnt'=>'Título ABNT',
			'nro_paginas'=>'Número de Páginas',
			'localizacao_sabi'=>'Localização Padrão Sabi',
			'nro_exemplares'=>'Número de Exemplares',
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

		$criteria->compare('cod_livro',$this->cod_livro);
		$criteria->compare('autor',$this->autor,true);
		$criteria->compare('ano',$this->ano,true);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('subtitulo',$this->subtitulo,true);
		$criteria->compare('editora',$this->editora,true);
		$criteria->compare('cidade_publicacao',$this->cidade_publicacao,true);
		$criteria->compare('nro_edicao',$this->nro_edicao,true);
		$criteria->compare('nro_patrimonio',$this->nro_patrimonio);
		$criteria->compare('cod_projeto',$this->cod_projeto);
		$criteria->compare('valor',$this->valor);
		$criteria->compare('local_compra',$this->local_compra,true);
		$criteria->compare('nro_nota_fiscal',$this->nro_nota_fiscal,true);
		$criteria->compare('isbn',$this->isbn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public static function fullUpper($string){ 
		  return strtr(strtoupper($string), array( 
		      "à" => "À", 
		      "è" => "È", 
		      "ì" => "Ì", 
		      "ò" => "Ò", 
		      "ù" => "Ù", 
		      "á" => "Á", 
		      "é" => "É", 
		      "í" => "Í", 
		      "ó" => "Ó", 
		      "ú" => "Ú",
		  	  "ü" => "Ü", 
		      "â" => "Â", 
		      "ê" => "Ê", 
	    	  "î" => "Î", 
		      "ô" => "Ô", 
		      "û" => "Û", 
		      "ç" => "Ç",
		  	  "ã" => "Ã",
		  	  "õ" => "Õ", 
		    )); 
	} 
	
	protected function setTituloAbnt(){
		
		/*
		 * Nome dos autores 
		 */
		
		$arrNomes = array();
		$pesquisadores = explode(', ',$this->autor);
		foreach($pesquisadores as $p){
			$arrNomes[] = Livro::nomeParaAbnt($p);
		}
		
		
		
		if(count($arrNomes) > 3){
			//Quando tem mais de 3 autores colocamos: Primeiro Autor et al
			$titulo = $arrNomes[0] . " et al";				
		}  else{
			 // Junta os nomes dos autores no formato ABNT
			$titulo = implode('; ', $arrNomes);
		}
		
		/*
		 * Junta o Título do artigo no formato ABNT
		 */
		
		$titulo .= ' ' . $this->titulo;
		if($this->subtitulo)
			$titulo .= ': ' .$this->subtitulo;
		
		$titulo .= '. ';
		
		if($this->nro_edicao)
		$titulo .= 'Edição ' .$this->nro_edicao .'. ';
		
		$titulo .= $this->cidade_publicacao .': ' .$this->editora;
		
		/*
		 * Junta a data de publicação no formato ABNT
		 */
		
		$titulo .= ', ' .$this->ano;
		
		$this->titulo_abnt = $titulo;
		
		
	}
	
	public static function nomeParaAbnt($nome){
		
		$arrNome = explode(" ", $nome);
		$nome_abnt  = Livro::fullUpper($arrNome[count($arrNome) -1]) .", ";
		for($i=0; $i < count($arrNome) -1; $i++){
			$nome_abnt .= substr($arrNome[$i], 0,1) .'.';
		}
		return $nome_abnt;
	}
	
	protected function afterFind(){
		$this->setTituloAbnt();
		
		$this->valor = number_format((doubleval($this->valor)),2,',','.');
		
		//$this->fillBookWithGoogle($this->isbn);
		parent::afterFind();
	}
	/**
	 * 
	 * Verifica se o livro contem emprestimos.
	 * @return boolean: true se o livro contém empréstimo, falso caso contrário.
	 */
	public function estaEmprestado(){
		$model = EmprestimoLivro::model()->findAll('cod_livro = '.$this->cod_livro .'AND data_devolucao is NULL');
		if(count($model) > 0)
			return true;
		
		return false;
		
	}
	
	public static function toArray(){
		$arrEditoras = array();
		$arrAutores = array();
		$arrCidades = array();
		
		//Coloca os nomes
		$livros = Livro::model()->findAll();
		foreach($livros as $livro){
			if(!in_array($livro->autor,$arrAutores))
				 $arrAutores[] = $livro->autor;
				 
			if(!in_array($livro->editora,$arrEditoras))
				 $arrEditoras[] = $livro->editora;
				 
			if(!in_array($livro->cidade_publicacao,$arrCidades))
				 $arrCidades[] = $livro->cidade_publicacao;
			
		}
		
		$arr = array('autores'=>$arrAutores,'editoras'=>$arrEditoras,'cidades'=>$arrCidades);
		return $arr;
	}	
	
}

