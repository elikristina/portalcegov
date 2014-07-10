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
 * @property string $rg
 * @property string $cpf
 * @property string $nome_mae
 * @property string $data_nascimento
 * @property string $telefone
 * @property string $celular
 * @property string $cartao_ufrgs
 * @property string $orgao_expedidor
 * @property string $pagina_pessoal
 * @property boolean $first_login
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
		if(Yii::app()->user->isGuest){
			return array(
			array('orgao_expedidor, orgao_departamento, instituicao, curso, email, senha, senha_confirm, nome, rg, cpf, nome_mae, data_nascimento, telefone', 'required'),
			array('email', 'unique'),
			array('first_login', 'boolean'),
			array('senha_confirm', 'validaSenha'),
			array('descricao, lattes, pesquisa, nome, descricao_en, imagem, rg, cpf, nome_mae, data_nascimento, telefone, celular, cartao_ufrgs, siape, orgao_departamento, instituicao, curso, first_login, info_adicional', 'safe'),
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
			array('cod_pessoa, descricao_en, descricao, pesquisa, lattes, nome, email, senha, curso', 'safe', 'on'=>'search'),
		);
			
		}else{
			
			return array(
			//array('endereco_profissional, orgao_departamento, instituicao, descricao, email, senha,lattes, senha_confirm, nome, rg, cpf, nome_mae, data_nascimento, nacionalidade, telefone, orgao_expedidor', 'required'),
			array('email, senha, senha_confirm, nome', 'required'),
			array('email', 'unique'),
			array('first_login', 'boolean'),
			array('senha_confirm', 'validaSenha'),
			array('descricao, lattes, nome, descricao_en, imagem, rg, cpf, nome_mae, data_nascimento, telefone, celular, cartao_ufrgs, orgao_expedidor, siape, orgao_departamento, instituicao, curso, first_login, info_adicional', 'safe'),
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
			array('cod_pessoa, descricao, pesquisa, lattes, nome, email, senha, curso', 'safe', 'on'=>'search'),
		);
			
		}
		
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
			'grupos_coordenador' => array(self::HAS_MANY, 'GrupoTrabalho', 'cod_coordenador', 'select'=>'cod_gt, nome, nome_en'),
			'grupos' => array(self::MANY_MANY, 'GrupoTrabalho', 'pessoa_gt(cod_pessoa, cod_gt)', 'select'=>'cod_gt, nome, nome_en'),
			'publicacoes_pessoais' => array(self::MANY_MANY, 'Publicacao', 'pessoa_publicacao(cod_pessoa, cod_publicacao)', 'condition'=>'pessoal = true', 'select'=>'cod_publicacao, titulo'),
			'publicacoes_cegov' => array(self::MANY_MANY, 'Publicacao', 'pessoa_publicacao(cod_pessoa, cod_publicacao)', 'condition'=>'pessoal = false', 'select'=>'cod_publicacao, titulo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'descricao' => Yii::t('Pessoa', 'descricao'),
			'descricao_en' => Yii::t('Pessoa', 'descricao_en'),
			'lattes' => Yii::t('Pessoa', 'lattes'),
			'imagem' => Yii::t('Pessoa', 'imagem'),
			'nome'=>Yii::t('Pessoa', 'nome'),
			'nome_sobrenome'=>Yii::t('Pessoa', 'nome_sobrenome'),
			'email' => Yii::t('Pessoa', 'email'),
			'senha' => Yii::t('Pessoa', 'senha'),
			'senha_confirm' => Yii::t('Pessoa', 'senha_confirm'),
			'categorias'=>Yii::t('Pessoa', 'categorias'),
			'imageFile'=>Yii::t('Pessoa', 'imageFile'),
			'rg' => Yii::t('Pessoa', 'rg'),
			'cpf' => Yii::t('Pessoa', 'cpf'),
			'nome_mae' => Yii::t('Pessoa', 'nome_mae'),
			'data_nascimento' => Yii::t('Pessoa', 'data_nascimento'),
			'telefone' => Yii::t('Pessoa', 'telefone'),
			'celular' => Yii::t('Pessoa', 'celular'),
			'cartao_ufrgs' => Yii::t('Pessoa', 'cartao_ufrgs'),
			'grupos' => Yii::t('Pessoa', 'grupos'),
			'orgao_expedidor' => Yii::t('Pessoa', 'orgao_expedidor'),
			'orgao_departamento'=>Yii::t('Pessoa', 'orgao_departamento'),
			'curso'=>Yii::t('Pessoa', 'curso'),
			'endereco_profissional'=>Yii::t('Pessoa', 'endereco_profissional'),
			'pagina_pessoal'=>Yii::t('Pessoa', 'pagina_pessoal'),
			'instituicao'=>Yii::t('Pessoa', 'instituicao'),
			'login'=>Yii::t('Pessoa', 'login'),
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
		$criteria->compare('rg',$this->rg,true);
		$criteria->compare('cpf',$this->cpf,true);
		$criteria->compare('nome_mae',$this->nome_mae,true);
		$criteria->compare('data_nascimento',$this->data_nascimento,true);
		$criteria->compare('telefone',$this->telefone,true);
		$criteria->compare('celular',$this->celular,true);
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
			if(!is_array($this->$attribute) || count($this->$attribute) < 1)
			 	$this->addError($attribute, 'Você deve especificar pelo menos uma categoria.');
	}
	
	public function validaGrupos($attribute, $params){
			if(!is_array($this->$attribute) || count($this->$attribute) < 1)
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

		//Pessoa
		$permited[] = $this->email;

		return $permited;
	}

	/**
	 * 
	 * Encontra uma pessoa a partir do seu username (email)
	 * @param string $email
	 * @return Pessoa $model se encontrar. null se não encontrar
	 */
	public static function findByEmail($email){
		$model = Pessoa::model()->find(array('condition'=>'email = :email', 'select'=>'cod_pessoa, email, nome, senha', 'params'=>array('email'=>$email)));

		return $model;
	}


    /**
     *
     * Encontra uma pessoa a partir do seu login ou email
     * @param string $username
     * @return Pessoa $model se encontrar. null se nÃ£o encontrar
     */
    public static function findForLogin($username){
    		if($username == null) return null;

            $model = Pessoa::model()->find(array('condition'=>'login = :user OR email = :user', 'select'=>'cod_pessoa, login, email, nome_curto, nome, password', 'params'=>array('user'=>$username)));
         
            return $model;
    }
	
	/*
	 * Aplica a lingagem atual ao modelo
	 * @see db/ar/CActiveRecord::defaultScope()
	public function defaultScope(){
		return array(
			'condition'=>'pessoa_lang = :lang',
			'params'=>array(':lang'=>Yii::app()->language)
		);
	}
	
	/**
	 * Aplica a linguagem por meio do parâmetro passado
	 * @param string $lang
	public function lang($lang){
		$this->getDbCriteria()->mergeWith(array(
			'condition'=>'pessoa_lang = :lang',
			'params'=>array(':lang'=>$lang)
		));
	}
	
/**
	 * (non-PHPdoc)
	 * @see db/ar/CActiveRecord::beforeSave()
	 
	public function beforeValidate(){
		$this->pessoa_lang = Yii::app()->language;
		parent::beforeValidate();
		return true;
	}
*/
	
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