<?php

/**
 * This is the model class for table "pessoa".
 *
 * The followings are the available columns in table 'pessoa':
 * @property integer $cod_pessoa
 * @property string $descricao
 * @property string $pesquisa
 * @property string $lattes
 * @property string $imagem
 * @property string $email
 * @property string $nome
 * @property string $senha
 * @property string $RG
 * @property string $CPF
 * @property string $nome_mae
 * @property string $data_nascimento
 * @property string $nacionalidade
 * @property string $telefone
 * @property string $cartao_ufrgs
 * @property string $orgao_expedidor
 * @property string $pagina_pessoal
 * 
 *
 * The followings are the available model relations:
 * @property Categoria[] $categorias
 * @property GrupoTrabalho[] $grupos_coordenador - GTs que esta pessoa coordena
 * @property GrupoTrabalho[] $grupos - GTs que esta pessoa atua
 * @property Publicacao[] $publicacoes_cegov - Publicacoes desta pessoa no CEGOV
 * @property Publicacao[] $publicacoes_pessoais - Publicacoes pessoais desta pessoa
 */
class Pessoa extends CActiveRecord
{
	public $senha_confirm;
	public $imageFile;
	public $imageLink;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Pessoa the static model class
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
		return 'pessoa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			//array('endereco_profissional, orgao_departamento, instituicao, descricao, email, senha,lattes, senha_confirm, nome, RG, CPF, nome_mae, data_nascimento, nacionalidade, telefone, orgao_expedidor', 'required'),
			array('nome, senha', 'required'),
			array('email', 'unique'),
			array('senha_confirm', 'validaSenha'),
			array('lattes, pesquisa, nome, imagem, RG, CPF, nome_mae, data_nascimento, nacionalidade, telefone, cartao_ufrgs, orgao_expedidor, pagina_pessoal', 'safe'),
			array('imageFile', 'file',
				 'types'=>'jpg, png, gif', 
				 'allowEmpty'=>true,
				 'tooLarge'	=>"Este arquivo é muito grande. Ele deve ter no máximo 400KB",
				 'maxSize'=> 1024*420 //400kb
					),
			array('categorias', 'validaCategoria'),
			array('grupos', 'validaGrupos'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cod_pessoa, descricao, pesquisa, lattes, nome, email, senha', 'safe', 'on'=>'search'),
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
			'categorias' => array(self::MANY_MANY, 'Categoria', 'pessoa_categoria(cod_pessoa, cod_categoria)'),
			'grupos_coordenador' => array(self::HAS_MANY, 'GrupoTrabalho', 'cod_coordenador'),
			'grupos' => array(self::MANY_MANY, 'GrupoTrabalho', 'pessoa_gt(cod_pessoa, cod_gt)'),
			'publicacoes_pessoais' => array(self::MANY_MANY, 'Publicacao', 'pessoa_publicacao(cod_pessoa, cod_publicacao)', 'condition'=>'pessoal = true'),
			'publicacoes_cegov' => array(self::MANY_MANY, 'Publicacao', 'pessoa_publicacao(cod_pessoa, cod_publicacao)', 'condition'=>'pessoal = false'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'descricao' => 'Descrição',
			'lattes' => 'Lattes',
			'imagem' => 'Imagem',
			'nome'=>'Nome',
			'email' => 'Email',
			'senha' => 'Senha',
			'senha_confirm' => 'Confirmação de Senha',
			'categorias'=>"Funções",
			'imageFile'=>"Foto",
			'RG' => 'RG',
			'CPF' => 'CPF',
			'nome_mae' => 'Nome da Mãe',
			'data_nascimento' => 'Data de Nascimento',
			'nacionalidade' => 'Nacionalidade',
			'telefone' => 'Telefone',
			'cartao_ufrgs' => 'Cartão UFRGS',
			'grupos' => 'Grupos de Trabalho',
			'orgao_expedidor' => 'Órgão Expedidor',
			'orgao_departamento'=>"Órgão / Departamento",
			'endereco_profissional'=>"Endereço Profissional",
			'pagina_pessoal'=>"Página Pessoal",
			'instituicao'=>"Instituição",
			
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

		$criteria->compare('cod_pessoa',$this->cod_pessoa);
		$criteria->compare('descricao',$this->descricao,true);
		$criteria->compare('lattes',$this->lattes,true);
		$criteria->compare('imagem',$this->imagem,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('senha',$this->senha,true);
		$criteria->compare('nome',$this->nome,true);
		$criteria->compare('RG',$this->RG,true);
		$criteria->compare('CPF',$this->CPF,true);
		$criteria->compare('nome_mae',$this->nome_mae,true);
		$criteria->compare('data_nascimento',$this->data_nascimento,true);
		$criteria->compare('nacionalidade',$this->nacionalidade,true);
		$criteria->compare('telefone',$this->telefone,true);
		$criteria->compare('cartao_ufrgs',$this->cartao_ufrgs,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
public static function getArrayMenu(){
		
		//Carrega o submenu de pesquisadores
		$categorias = Categoria::model()->findALL(array('order'=>'ordem,nome'));
		$menuPesquisadores = array();
		$itemPesquisador = array();
		
	
		foreach($categorias as $categoria){
			
			//Só pega categorias que tem pessoas			
			if(count($categoria->pessoas) > 0){
				$itemPesquisador["label"] = $categoria->nome;
				$itemPesquisador["url"] = array("pessoa/function", 'id'=>$categoria->cod_categoria);
				//Para cada categoria pega os pesquisadores dela.
				/*
				$items = array();
				$items = Pessoa::getArrayMenuCategoria($categoria->cod_categoria);
				if(count($items) > 0)
					$itemPesquisador["items"] =  $items;
				 else 
				 */
				   $itemPesquisador["items"] = null;
				$menuPesquisadores[] = $itemPesquisador;
			}
		}
		
		if(!Yii::app()->user->isGuest){
			$menuPesquisadores[] = array('label'=>"Gerenciar Equipe", 'url'=>array("pessoa/admin"));
		}
		
	return $menuPesquisadores;
			
}



/**
 * 
 * A partir de um ID de uma categoria retorna um menu com as pessoas desta categoria
 * @param $id
 */
	
public static function getArrayMenuCategoria($id){
		
		
		$criteria=new CDbCriteria;
		
		$criteria->with = array('categorias');
		$criteria->order = 't.nome ASC';
		$criteria->condition = "categorias.cod_categoria = " .$id;
		
		//Carrega o submenu de pesquisadores
		$pesquisadores = Pessoa::model()->findALL($criteria);
		$menuPesquisadores = array();
		$itemPesquisador = array();
	
		for($i=0;$i<count($pesquisadores);$i++){
			
				$itemPesquisador["label"] = $pesquisadores[$i]->nome;

			$itemPesquisador["url"] = array("/pessoa/" .$pesquisadores[$i]->cod_pessoa); 
			$menuPesquisadores[] = $itemPesquisador;
		}
		
	return $menuPesquisadores;
		
	}
	
	public function validaCategoria($attribute, $params){
			if(count($this->$attribute) < 1)
			 	$this->addError($attribute, 'Você deve especificar pelo menos uma categoria.');
	}
	
	public function validaGrupos($attribute, $params){
			if(count($this->$attribute) < 1)
			 	$this->addError($attribute, 'Você deve especificar pelo menos um Grupo de Trabalho.');
	}
	
	public function validaSenha($attribute, $params){
				if($this->$attribute != $this->senha){
						$this->addError($attribute, 'Senha e confirmação de senha devem ser a iguais.');	
				}
			 	
	}
	
	public function afterFind(){
		 $this->senha_confirm = $this->senha;
		 $this->imageFile = Yii::getPathOfAlias('webroot.images.profiles') .DIRECTORY_SEPARATOR .$this->imagem ;
		 $this->imageLink = Yii::app()->request->baseUrl .'/images/profiles/' .$this->imagem;
		parent::afterFind();
	}


}