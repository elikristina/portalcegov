<?php

/**
 * This is the model class for table "pessoa".
 *
 * The followings are the available columns in table 'pessoa':
 * @property integer $cod_pessoa
 * @property string $nome
 * @property string $nome_curto
 * @property string $nome_mae
 * @property string $telefone
 * @property string $cpf
 * @property string $rg
 * @property string $cartao_ufrgs
 * @property integer $cod_projeto_atuante
 * @property string $email
 * @property string $cidade
 * @property string $rua_complemento
 * @property string $bairro
 * @property string $cep
 * @property string $banco
 * @property string $agencia
 * @property string $conta_corrente
 * @property string $lattes
 * @property string $password
 * @property string $data_nascimento
 * @property integer $cod_vinculo_institucional
 * @property string $cod_banco
 * @property boolean $status_equipe
 * @property string $login
 * @property integer $nivel_acesso
 * @property integer $old_cod_pessoa
 *
 * The followings are the available model relations:
 * @property PessoaFinanceiro[] $pessoaFinanceiro
 * @property Projeto[] $projetos
 * @property VinculoInstitucional $vinculo_institucional
 * @property Projeto[] $projetos_atuante
 * @property Atividade[] $atividades
 * @property Atividade[] $atividades_responsavel
 * @property FuncoesPessoa[] $funcoes
 * @property Pessoa[] $pessoas_permitidas
 * @property PessoaCategoria $categoria
 *
 */
class Pessoa extends CActiveRecord
{
        //vars
        public $equipe="";
        public $id;
        public $name;
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
                        array('nome, nome_mae, endereco_residencial, email', 'required'),
                        array('email', 'unique', 'message'=>'O e-mail {value} já está em uso.'),
                        array('first_login, equipe_atual', 'boolean'),
                        //array('projetos_atuante', 'validaProjetos'),
                        array('cod_projeto_atuante, cod_vinculo_institucional, nivel_acesso', 'numerical', 'integerOnly'=>true),
                        array('telefone, cpf, rg, login, cartao_ufrgs, email, cidade, rua_complemento, bairro, cep, banco, agencia, conta_corrente, lattes, data_nascimento, cod_banco, equipe_atual, cod_categoria, nome_curto, password, first_login', 'safe'),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('cod_pessoa, nome, nome_mae, login, telefone, cpf, rg, cartao_ufrgs, cod_projeto_atuante, email, cidade, rua_complemento, bairro, cep, banco, agencia, conta_corrente, lattes, data_nascimento, cod_vinculo_institucional, cod_banco, old_cod_pessoa', 'safe', 'on'=>'search'),
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
                    /*
                    'pessoa_financeiro' => array(self::HAS_MANY, 'PessoaFinanceiro', 'cod_pessoa'),
                    'funcoes' => array(self::HAS_MANY, 'FuncoesPessoa', 'cod_pessoa'),
                    'projetos' => array(self::HAS_MANY, 'Projeto', 'cod_professor'),
                    'vinculo_institucional' => array(self::BELONGS_TO, 'VinculoInstitucional', 'cod_vinculo_institucional'),
                    
                    'projetos_atuante' => array(self::MANY_MANY, 'Projeto', 'projeto_pessoa_atuante(cod_pessoa, cod_projeto)'),
                    'grupos' => array(self::MANY_MANY, 'Grupo', 'pessoa_grupo(cod_pessoa, cod_grupo)'),
                    'atividades' => array(self::MANY_MANY, 'Atividade', 'atividade_pessoa(cod_pessoa, cod_atividade)'),
                    'atividades_responsavel' => array(self::HAS_MANY, 'Atividade', 'cod_pessoa'),
                    'permissao_projeto' => array(self::MANY_MANY, 'Projeto', 'permissao_projeto(cod_pessoa, cod_projeto)'),
                    */
                    'pessoa_financeiro' => array(self::HAS_MANY, 'PessoaFinanceiro', 'cod_pessoa'),
                    'funcoes' => array(self::HAS_MANY, 'FuncoesPessoa', 'cod_pessoa'),
                    'projetos' => array(self::HAS_MANY, 'Projeto', 'cod_professor'),
                    'vinculo_institucional' => array(self::BELONGS_TO, 'VinculoInstitucional', 'cod_vinculo_institucional'),
                    //OBSOLETO 'categoria' => array(self::BELONGS_TO, 'PessoaCategoria', 'cod_categoria'),
                    //'projeto_atuante' => array(self::BELONGS_TO, 'Projeto', 'cod_projeto_atuante'),
                    'projetos_atuante' => array(self::MANY_MANY, 'Projeto', 'projeto_pessoa_atuante(cod_pessoa, cod_projeto)'),
                    'grupos' => array(self::MANY_MANY, 'Grupo', 'pessoa_grupo(cod_pessoa, cod_grupo)'),
                    'atividades' => array(self::MANY_MANY, 'Atividade', 'atividade_pessoa(cod_pessoa, cod_atividade)'),
                    'atividades_responsavel' => array(self::HAS_MANY, 'Atividade', 'cod_pessoa'),
                    'permissao_projeto' => array(self::MANY_MANY, 'Projeto', 'permissao_projeto(cod_pessoa, cod_projeto)'),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                'cod_pessoa' => 'Código',
                'nome' => 'Nome Completo',
                'nome_curto'=>'Apelido',
                'nome_mae' => 'Nome Completo da Mãe',
                'telefone' => 'Telefone',
                'cpf' => 'CPF',
                'rg' => 'RG',
                'cartao_ufrgs' => 'Número de Matrícula',
                'cod_projeto_atuante' => 'Projeto Atuante',
                'email' => 'Email',
                'cidade' => 'Cidade',
                'rua_complemento' => 'Rua e Complemento',
                'bairro' => 'Bairro',
                'cep' => 'CEP',
                'banco' => 'Banco',
                'agencia' => 'Agência',
                'conta_corrente' => 'Conta Corrente',
                'lattes' => 'Currículo Lattes',
                'data_nascimento' => 'Data de Nascimento',
                'cod_vinculo_institucional' => 'Vínculo Institucional',
                'cod_banco' => 'Código do Banco',
                'login'=>'Login',
                'projetos_atuante' => 'Projetos em que atua',
                'cod_categoria'=>'Função',
                'categoria'=>'Funçao',
                'password'=>'Senha',
                'nivel_acesso'=>'Nível de Acesso',

                //CEGOV
                'descricao' => Yii::t('Pessoa', 'descricao'),
                'descricao_en' => Yii::t('Pessoa', 'descricao_en'),
                'imagem' => Yii::t('Pessoa', 'imagem'),
                'nome_sobrenome'=>Yii::t('Pessoa', 'nome_sobrenome'),
                'categorias'=>Yii::t('Pessoa', 'categorias'),
                'imageFile'=>Yii::t('Pessoa', 'imageFile'),
                'celular' => Yii::t('Pessoa', 'celular'),
                'gts' => Yii::t('Pessoa', 'gts'),
                'orgao_expedidor' => Yii::t('Pessoa', 'orgao_expedidor'),
                'orgao_departamento'=>Yii::t('Pessoa', 'orgao_departamento'),
                'curso'=>Yii::t('Pessoa', 'curso'),
                'endereco_profissional'=>Yii::t('Pessoa', 'endereco_profissional'),
                'pagina_pessoal'=>Yii::t('Pessoa', 'pagina_pessoal'),
                'instituicao'=>Yii::t('Pessoa', 'instituicao'),
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
                $criteria->compare('nome_mae',$this->nome_mae,true);
                $criteria->compare('telefone',$this->telefone,true);                
                $criteria->compare('email',$this->email,true);                
                $criteria->compare('cartao_ufrgs',$this->cartao_ufrgs,true);

                return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
                ));
        }

        public static function toArray(){
                $arr = array();
                $pessoas = Pessoa::model()->findAll(array('select'=>'nome'));
                foreach($pessoas as $p){
                        $arr[] = $p->nome;
                }
                return $arr;
        }

        public static function isInVacation($id){

                $hoje = date('Y-m-d');
                $condition = "cod_pessoa = :id AND";
                $condition .= " data_inicio <= :hoje AND ";
                $condition .= " data_fim >= :hoje ";

                $pessoas = Ferias::model()->findAll($condition, array('hoje'=>$hoje, 'id'=>$id));

                if(!empty($pessoas)){
                        return true;
                }

                return false;
        }

        public function afterFind(){

                if($this->equipe_atual){
                        $this->equipe = "Equipe Atual";
                }else{
                        $this->equipe = "Outras Pessoas";
                }

                if($this->nome_curto == null){
                        $this->nome_curto = $this->nome;
                }

                $this->id = $this->cod_pessoa;
                $this->name = $this->nome;

                parent::afterFind();
        }

     


        public function getAtividadesParticipaByDate($data_inicio = null, $data_fim = null, $atividadesParticipaFinalizadas=true){
                $criteria =new CDbCriteria();
                $criteria->with = array('pessoas');


                // Condição pra pegar só atividades que participa e não é responsavel!
                $criteria->addCondition('t.cod_pessoa <> :cod_pessoa', 'AND');
                $criteria->addCondition('pessoas.cod_pessoa = :cod_pessoa', 'AND');
                $criteria->params['cod_pessoa']=$this->cod_pessoa;
                if(!$atividadesParticipaFinalizadas){
                        $criteria->addCondition('status <> 2', 'AND');
                }
                if($data_inicio != null){
                        $criteria->addCondition('data_inicio >= :data_inicio', 'AND');
                        $criteria->params['data_inicio']=$data_inicio;
                }

                if($data_fim != null){
                        $criteria->addCondition('data_fim <= :data_fim', 'AND');
                        $criteria->params['data_fim']=$data_fim;
                }

                $criteria->order = 't.status, t.data_fim ASC';
                $atividades = Atividade::model()->findAll($criteria, array('data_inicio'=>$data_inicio, 'data_fim'=>$data_fim, 'id_pessoa'=>$this->cod_pessoa));

                return $atividades;
        }

        public function getAtividadesResponsavelByDate($data_inicio = null, $data_fim = null, $atividadesResponsavelFinalizadas = true){
                $criteria =new CDbCriteria();
                $criteria->params = array();

                $criteria->addCondition('t.cod_pessoa = :cod_pessoa', 'AND');
                $criteria->params['cod_pessoa']=$this->cod_pessoa;

                if(!$atividadesResponsavelFinalizadas){
                        $criteria->addCondition('status <> 2', 'AND');
                }
                if($data_inicio != null){
                        $criteria->addCondition('data_inicio >= :data_inicio', 'AND');
                        $criteria->params['data_inicio']=$data_inicio;
                }

                if($data_fim != null){
                        $criteria->addCondition('data_fim <= :data_fim', 'AND');
                        $criteria->params['data_fim']=$data_fim;
                }

                $criteria->order = 't.status, t.data_fim ASC';
                $atividades = Atividade::model()->findAll($criteria, array('data_inicio'=>$data_inicio, 'data_fim'=>$data_fim, 'id_pessoa'=>$this->cod_pessoa));

                return $atividades;
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

       /**
         *
         * Valida se o usuario especificou pelo menos um projeto
         * @param unknown_type $attribute
         * @param unknown_type $params
         */
        public function validaProjetos($attribute,$params){
                         if(count($this->$attribute) < 1)
                                $this->addError($attribute, 'Você deve especificar pelo menos um projeto.');
        }


        /**
         *
         * Dado um identificador do usuÃ¡rio retorna seu nÃ­vel de acesso
         * @param integer $id
         * @return integer $accessLevel
         */
        public static function getAccessLevel($id){
                if(Yii::app()->user->isGuest)
                        return Sipesq::DENIED_PERMITION;
                $pessoa = Pessoa::model()->findByPk($id);
                return $pessoa->nivel_acesso;
        }


}