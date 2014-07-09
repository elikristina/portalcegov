<?php

/**
 * This is the model class for table "projeto".
 *
 * The followings are the available columns in table 'projeto':
 * @property integer $cod_projeto
 * @property string $nome
 * @property string $nome_curto
 * @property string $codigo_projeto
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $data_relatorio
 * @property string $ultima_modificacao
 * @property string $descricao
 * @property string $situacao
 * @property boolean $finalizado
 * @property double $verba_custeio
 * @property double $verba_capital
 * @property double $verba_bolsa
 * @property string $instrumento_juridico]
 * @property string gt
 * @property string natureza
 *
 *
 * The followings are the available model relations:
 * @property ProjetoFinanceiro[] $projeto_financeiro
 * @property PessoaFinanceiro[] $pessoas_recebimento
 * @property Pessoa $coordenador
 * @property Pessoa $professor
 * @property Pessoa $pos_graduando
 * @property Pessoa $graduando
 * @property ProjetoCategoria $categoria
 * @property Pessoa[] $pessoas
 * @property Pessoa[] $pessoas_inativas
 * @property Pessoa[] $pessoas_permitidas
 * @property PatrimonioTermos[] $patrimonio_termos
 * @property Livro[] $livros
 * @property Atividade[] $atividades
 * @property Atividade[] $atividades_finalizadas
 *
 * Financeiro Novo
 * @property ProjetoDespesa[] $despesas
 * @property ProjetoReceita[] $receitas
 * @property ProjetoOrcamento[] $orcamentos
 * @property double $verba_orcamentada
 * @property double $verba_recebida
 *
 */
class Projeto extends CActiveRecord
{
        //NOVO FINANCEIRO
        public
                $gasto_corrente = 0
        ,       $gasto_comprometido = 0
        ,       $saldo_corrente = 0
        ,       $saldo_disponivel = 0
        ,       $verba_recebida = 0;

        //Fim novo financeiro.

        public
                $convenio = '{}'
        ,       $instrumento_juridico ='{}'
        ,       $situacao_text = ''
        ,       $class = "label-info"
        ,       $situacoes = array(
                'Elaboração',
                'Negociação',
                'Tramitação',
                'Em andamento',
                'Prestação de Contas',
                'Encerrado',
                'Cancelado',
        );


        /*/Gastos
        public $gasto_bolsa;
        public $gasto_custeio;
        public $gasto_capital;
        public $gasto_outros;
        public $gasto_servico;
        public $gasto_livros;
        public $gasto_patrimonios;

        public $recebido_custeio;
        public $recebido_bolsa;
        public $recebido_capital;

        //Verbas
        public $verba_outros;
        */

        public static $momentos = array(
                        'Elaboração',
                        'Negociação',
                        'Tramitação',
                        'Andamento',
                        'Prestação de Contas',
                        'Encerrados',
                        'Cancelados',
        );

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
                        array('nome, nome_curto, cod_categoria, cod_grad, cod_pos_grad, cod_professor, cod_bolsista_responsavel', 'required'),
                        //array('cod_professor', 'validaResponsavel', 'cod_pos_grad', 'cod_grad'),
                        //array('cod_grad', 'validaResponsavel', 'cod_pos_grad', 'cod_professor'),
                        //array('cod_pos_grad', 'validaResponsavel', 'cod_professor', 'cod_grad'),
                        array('cod_professor, cod_grad, cod_pos_grad,  cod_categoria, cod_bolsista_responsavel', 'numerical', 'integerOnly'=>true),
                        array('codigo_projeto, finalizado, situacao, data_inicio, data_fim, data_relatorio,ultima_modificacao, descricao, pessoas, nome_curto, instrumento_juridico, convenio, skydrive, gt, natureza', 'safe'),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('cod_projeto, nome, codigo_projeto, data_inicio, data_fim, data_relatorio, descricao, verba_custeio, verba_capital, verba_bolsa', 'safe', 'on'=>'search'),
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
                        //Coordenadores
                        'coordenador' => array(self::BELONGS_TO, 'Pessoa', 'cod_professor', 'select'=>'cod_pessoa, nome'),
                        'vice_coordenador' => array(self::BELONGS_TO, 'Pessoa', 'cod_pos_grad', 'select'=>'cod_pessoa, nome'),
                        'fiscal' => array(self::BELONGS_TO, 'Pessoa', 'cod_grad', 'select'=>'cod_pessoa, nome'),
                        'bolsista_responsavel' => array(self::BELONGS_TO, 'Pessoa', 'cod_bolsista_responsavel', 'select'=>'cod_pessoa, nome'),

                        //Equipe
                        'pessoas' => array(self::MANY_MANY, 'Pessoa', 'projeto_pessoa_atuante(cod_pessoa, cod_projeto)', 'order'=>'pessoas.nome', 'select'=>'cod_pessoa, nome', 'condition'=>'ativo = true'),
                        'pessoas_inativas' => array(self::MANY_MANY, 'Pessoa', 'projeto_pessoa_atuante(cod_pessoa, cod_projeto)', 'order'=>'pessoas_inativas.nome', 'select'=>'cod_pessoa, nome', 'condition'=>'ativo = false'),

                        // Grupo de Trabalho
                        'gt' => array(self::BELONGS_TO, 'GrupoTrabalho', 'cod_gt', 'select'=>'cod_gt, nome'),

                        //Atividades
                        'atividades' => array(self::MANY_MANY, 'Atividade', 'atividade_projeto(cod_atividade, cod_projeto)', 'order'=>'atividades.estagio, atividades.data_fim asc'),
                        'atividades_finalizadas' => array(self::MANY_MANY, 'Atividade', 'atividade_projeto(cod_atividade, cod_projeto)', 'order'=>'atividades_finalizadas.data_fim asc', 'condition'=>'atividades_finalizadas.estagio = true'),

                        'livros' => array(self::HAS_MANY, 'Livro', 'cod_projeto', 'order'=>'titulo', 'select'=>'cod_livro, titulo'),
                        'categoria' => array(self::BELONGS_TO, 'ProjetoCategoria', 'cod_categoria'),
                        'permissoes'=>array(self::HAS_MANY, 'PermissaoProjeto', 'cod_projeto'),

                        'documentos' => array(self::HAS_MANY, 'ProjetoArquivo', 'cod_projeto'),
                        'despesas' => array(self::HAS_MANY, 'ProjetoDespesa', 'cod_projeto'),
                        'receitas' => array(self::HAS_MANY, 'ProjetoVerba', 'cod_projeto', 'order'=>'cod_verba'),
                        'orcamentos' => array(self::HAS_MANY, 'ProjetoOrcamento', 'cod_projeto'),
                        'verba_orcamentada'=>array(self::STAT, 'ProjetoOrcamento', 'cod_projeto', 'select' => 'SUM(valor)'),
                        'pessoas_permitidas' => array(self::MANY_MANY, 'Pessoa', 'permissao_projeto(cod_projeto, cod_pessoa)'),


                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array(
                        'cod_projeto' => 'ID',
                        'nome' => 'Nome',
                        'nome_curto'=>'Abreviatura',
                        'codigo_projeto'=>'Código do Projeto',
                        'data_inicio'=>'Início',
                        'data_fim' =>'Término',
                        'data_relatorio'=> 'Data do Relatório',
                        'descricao' =>'Descricao',
                        'situacao'=>'Situação',
                        'situacao_text'=>'Situação',
                        'verba_custeio' =>'Verba Custeio',
                        'verba_capital' =>'Verba Capital',
                        'verba_bolsa' => 'Verba Bolsa',
                        'verba_outros'=>'Verba Outros',
                        'gasto_outros'=>'Gasto Outros',
                        'gasto_custeio'=>'Gasto Custeio',
                        'gasto_capital'=>'Gasto Capital',
                        'gasto_bolsa'=>'Gasto Bolsa',
                        'finalizado'=>'Finalizado',
                        'cod_categoria'=>'Tipo de Projeto',
                        //Coordenador,Vice-Coordenador, Fiscal, Bolsista Responsável
                        'cod_professor'=>'Coordenador',
                        'cod_pos_grad'=>'Vice-Coordenador',
                        'cod_grad'=>'Fiscal',
                        'cod_bolsista_responsavel'=>'Bolsista Responsável',

                        'coordenador' => 'Coordenador',
                        'vice_coordenador' => 'Vice-Coordenador',
                        'fiscal' => 'Fiscal',
                        'gt'=>'Grupo de Trabalho',
                        'natureza'=>'Natureza do Projeto',

                        /*
                        'cod_professor'=>'Professor',
                        'cod_pos_grad'=>'Pós-Graduando',
                        'cod_grad'=>'Graduando',*/
                        'skydrive'=>'Pasta no Skydrive',
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
                $criteria->compare('codigo_projeto',$this->codigo_projeto,true);
                $criteria->compare('data_inicio',$this->data_inicio,true);
                $criteria->compare('data_fim',$this->data_fim,true);
                $criteria->compare('data_relatorio',$this->data_relatorio,true);
                $criteria->compare('descricao',$this->descricao,true);
                $criteria->compare('verba_custeio',$this->verba_custeio);
                $criteria->compare('verba_capital',$this->verba_capital);
                $criteria->compare('verba_bolsa',$this->verba_bolsa);

                return new CActiveDataProvider(get_class($this), array(
                        'criteria'=>$criteria,
                ));
        }

        protected function afterValidate(){

                if ($this->hasErrors()){
                        $this->instrumento_juridico = InstrumentoJuridico::load(json_decode($this->instrumento_juridico));
                        $this->convenio = Convenio::load(json_decode($this->convenio));
                }

                parent::afterValidate();
        }
        protected function afterFind(){

                //$this->calculaGastosVerbas();
                $this->defineClassFromStatus();

                $this->instrumento_juridico = InstrumentoJuridico::load(json_decode($this->instrumento_juridico));
                $this->convenio = Convenio::load(json_decode($this->convenio));


                //Coloca a situação do projeto
                if($this->situacao == null)
                        $this->situacao = 0;


                $this->situacao_text = $this->situacoes[$this->situacao];

                if($this->nome_curto == null || $this->nome_curto == ''){
                        $this->nome_curto = substr($this->nome,0, 20);
                }

                //Calcula o financeiro novo
                $this->calcFinanceiro();

        }

        protected function beforeSave(){
                $this->ultima_modificacao = date("Y-m-d");
                parent::beforeSave();
                return true;
        }


        private function calculaGastosVerbas(){

                //Inicialização das propriedades de gastos e verbas

                         //Gastos
                         $this->gasto_bolsa = 0;
                         $this->gasto_custeio = 0;
                         $this->gasto_capital = 0;
                         $this->gasto_outros = 0;
                         $this->gasto_servico = 0;

                         //Verbas
                         $this->verba_outros = 0;
                         $this->recebido_bolsa = 0;
                         $this->recebido_capital = 0;
                         $this->recebido_custeio = 0;



                foreach ($this->projeto_financeiro as $financa){

                                if($financa->categoria->nome == 'gasto_custeio') //se gasto custeio
                                        $this->gasto_custeio += $financa->valor;

                                if($financa->categoria->nome == 'gasto_capital') //se gasto capital
                                        $this->gasto_capital += $financa->valor;

                                if($financa->categoria->nome == 'gasto_outros') //se gasto outros
                                        $this->gasto_outros += $financa->valor;

                                if($financa->categoria->nome == 'gasto_bolsa') //se gasto bolsa
                                        $this->gasto_bolsa += $financa->valor;

                                if($financa->categoria->nome == 'verba_custeio') //se verba custeio
                                        $this->recebido_custeio += $financa->valor;
                                        //$this->verba_custeio += $financa->valor;

                                if($financa->categoria->nome == 'verba_capital') //se verba capital
                                        $this->recebido_capital += $financa->valor;
                                //$this->verba_capital += $financa->valor;

                                if($financa->categoria->nome == 'verba_bolsa') //se verba bolsa
                                        $this->recebido_bolsa += $financa->valor;
                                //$this->verba_bolsa += $financa->valor;

                                if($financa->categoria->nome == 'verba_outros') //se verba outros
                                        $this->verba_outros += $financa->valor;



                         //endforeach
                        }

                        //Implementa os gasto capital coms os patrimonios
                        $this->gasto_patrimonios = 0;
                        foreach ($this->patrimonio_termos as $termo){
                                $this->gasto_patrimonios += $termo->valor_total;
                        }

                        //Atualiza os gastos com capital
                        $this->gasto_capital += $this->gasto_patrimonios;

                        //Calcula o gasto com bolsas e serviços
                        foreach ($this->pessoas_recebimento as $recebimento){
                                if($recebimento->cod_categoria != 3) //se não for serviço
                                        $this->gasto_bolsa += $recebimento->valor_total;
                                else{
                                        $this->gasto_servico += $recebimento->valor_total;
                                }
                        }



                        //Calcula gastos com livros
                        $this->gasto_livros = 0;
                        foreach ($this->livros as $livro){
                                $this->gasto_livros += $livro->valor;
                        }

                        //Atualiza gastos com custeio
                        $this->gasto_custeio += $this->gasto_servico;
                        $this->gasto_custeio += $this->gasto_livros;



                //end calculaGastosVerbas
        }

        /**
         *
         * Retorna os  projetos que acabam em 6 meses
         */
        public static function getLasts(){
                $criteria = new CDbCriteria();
                $dataLimite =  date("d/m/Y", mktime(0, 0, 0, date("m") + 6, date("d"), date("Y")));
                $dataAtual = date("d/m/Y");
                $criteria->addCondition("t.data_fim <= '$dataLimite'", 'AND');
                $criteria->addCondition("t.data_fim >= '$dataAtual'", 'AND');
                $criteria->order = 't.data_fim DESC, t.nome ASC';
                return Projeto::model()->findALL($criteria);;
        }

        /**
         * retorna um array de logins permitidos a fazer determinada ação com determinado nível
         * @param $nivel
         * @return array $logins[]
         */
        public function loginsPermitidos($nivel){

                $criteria = new CDbCriteria();
                $criteria->with = array('pessoa', 'projeto');
                $criteria->addCondition("nivel_permissao >= '$nivel'", 'AND');
                $criteria->addCondition("t.cod_projeto = '$this->cod_projeto'", 'AND');

                $loginsArray = array();
                $pesPermitidas = PermissaoProjeto::model()->findAll($criteria);

                foreach($pesPermitidas as $p){
                        $loginsArray[] = $p->pessoa->login;
                }


                foreach($this->pessoas as $p){
                        $loginsArray[] = $p->login;
                }

                return $loginsArray;

        }

        /**
         *
         * Retorna um array com os logins das pessoas participantes permitidas a ver o projeto
         * @return array $pessoas[]
         */
        public function pessoasAtuantesToArray(){
                $pessoas = array();

                foreach($this->pessoas as $p){
                        $pessoas[] += $p->login;
                }

                return $pessoas;
        }

        /**
         *
         * Valida se uma pessoa é responsável em mais de um tipo de categoria (professor, pos, grad)
         * @param $attribute
         * @param array $params
         */
        public function validaResponsavel($attribute,$params){
                if($this->$attribute == $this->$params[0] || $this->$attribute == $this->$params[1])
                 $this->addError($attribute, 'Você deve especificar uma pessoa diferente.');
        }


        /**
         * Define a classe do projeto
         * Verde: O projeto está finalizado
         * Amarelo: O projeto está em andamento
         * Vermelho: O projeto está acabando
         * @param int $gap - Número de meses para alertar fim do projeto.
         */
        private function defineClassFromStatus($gap=1){

                //Verifica se o projeto está acabando
                if(date('Y') - date('Y', strtotime($this->data_fim)) == 0)
                        if(date('m', strtotime($this->data_fim)) - date('m') <= $gap){
                                $this->class = 'label-important';
                        }

                //Verifica se o projeto já acabou
                if($this->finalizado){
                        $this->class = "label-success";
                }

        }

        /**
         *
         * Formata todos os numeros
         */
        private function formatNumbers(){
                $this->gasto_bolsa = number_format($this->gasto_bolsa, 2, '.', '');
                $this->gasto_capital = number_format($this->gasto_capital, 2, '.', '');
                $this->gasto_custeio = number_format($this->gasto_custeio, 2, '.', '');
                $this->gasto_outros = number_format($this->gasto_outros, 2, '.', '');
                $this->gasto_patrimonios = number_format($this->gasto_patrimonios, 2, '.', '');
                $this->gasto_servico = number_format($this->gasto_servico, 2, '.', '');
                $this->gasto_livros = number_format($this->gasto_livros, 2, '.', '');

                $this->verba_bolsa = number_format($this->verba_bolsa, 2, '.', '');
                $this->verba_capital = number_format($this->verba_capital, 2, '.', '');
                $this->verba_custeio = number_format($this->verba_custeio, 2, '.', '');
                $this->verba_outros = number_format($this->verba_outros, 2, '.', '');

        }



        /**
         *
         * Retorna menu de ações da pagina principal de projetos
         * @return array()
         */
        public function viewMenu(){
                if(Sipesq::isSupport()){
                                return array(
                                array('label'=>'<i class="icon-list"></i> Projetos', 'url'=>array('index')),
                                array('label'=>'<i class="icon-print"></i> Gerar Relatório', 'url'=>array('relatorio', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-plus"></i> Projeto', 'url'=>array('create')),
                                //array('label'=>'<i class="icon-plus"></i> Bolsa/Recebimento', 'url'=>array('pessoaFinanceiro/create', 'projeto'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-plus"></i> Livro', 'url'=>array('livro/create', 'projeto'=>$this->cod_projeto)),
                                //array('label'=>'<i class="icon-plus"></i> Patrimônio', 'url'=>array('patrimonioTermo/create', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-plus"></i> Documento', 'url'=>array('createFile', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-trash"></i> Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$this->cod_projeto),'confirm'=>'Tem certeza que deseja excluir este projeto?')),
                                array('label'=>'<i class="icon-tasks"></i> Gerenciar Permissões', 'url'=>array('permissoes', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-tasks"></i> Gerenciar Projetos', 'url'=>array('admin')),
                        );
                }else{
                        return array(
                                array('label'=>'<i class="icon-print"></i> Gerar Relatório', 'url'=>array('relatorio', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-pencil"></i> Editar', 'url'=>array('update', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-trash"></i> Excluir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$this->cod_projeto),'confirm'=>'Tem certeza que deseja excluir este projeto?')),
                                //array('label'=>'<i class="icon-plus"></i> Bolsa/Recebimento', 'url'=>array('pessoaFinanceiro/create', 'projeto'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-plus"></i> Livro', 'url'=>array('livro/create', 'projeto'=>$this->cod_projeto)),
                                //array('label'=>'<i class="icon-plus"></i> Patrimônio', 'url'=>array('patrimonioTermo/create', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-plus"></i> Documento', 'url'=>array('createFile', 'id'=>$this->cod_projeto)),
                                array('label'=>'<i class="icon-tasks"></i> Gerenciar Permissões', 'url'=>array('permissoes', 'id'=>$this->cod_projeto), 'visible'=>$this->isSupport(null, $this->cod_projeto)),
                        );
                }

        }


        /**
         *
         * Verifica se o usuário é membro do projeto.
         * @param integer $id
         */
        public function isMember($id=null){


                if($id == null){
                        $id = Yii::app()->user->getId();
                }

                //      Se for admin já retorna permissão de acesso
                if(Sipesq::isSupport($id))
                        return true;

                        //Verifica se atua no projeto
                if(ProjetoPessoaAtuante::model()->count('cod_projeto = :proj AND cod_pessoa = :id', array('id'=>$id, 'proj'=>$this->cod_projeto)) > 0)
                        return true;

                //verifica se é um dos coordenadores
                if(Projeto::model()->count('cod_projeto = :proj AND (cod_professor = :id OR cod_grad = :id OR cod_pos_grad = :id)', array('id'=>$id, 'proj'=>$this->cod_projeto)))
                        return true;

                //verifica se alguem delegou uma permissão a este usuário
                if(PermissaoProjeto::model()->count('cod_projeto = :projeto AND cod_pessoa = :id', array('id'=>$id, 'projeto'=>$this->cod_projeto)))
                        return true;

                //o usuário não é permitido
                return false;

        }

          /**
         * Verifica se um determinado usuário tem permissão de suporte de um determinado projeto
         * @param integer $pessoa
         * @param integer $projeto
         */
                public function isSupport($pessoa=null){

                        if($pessoa == null)
                                $pessoa = Yii::app()->user->getId();

                        if(Sipesq::isSupport($pessoa))
                                return true;

                        if(Projeto::model()->count('cod_projeto = :proj AND (cod_professor = :id OR cod_grad = :id OR cod_pos_grad = :id)', array('id'=>$pessoa, 'proj'=>$this->cod_projeto)))
                                return true;

                        //verifica se alguem delegou uma permissão a este usuário
                        if(PermissaoProjeto::model()->count('cod_projeto = :projeto AND cod_pessoa = :id AND nivel_permissao >= :nivel',array('id'=>$pessoa, 'projeto'=>$this->cod_projeto, 'nivel'=>Sipesq::SUPPORT_PERMITION)) > 0)
                                return true;

                        return false;

                }



        /**
         * @param $id - Identificador de uma Pessoa
         */
                public static function findAllOfUser($id=null){

                        $criteria = new CDbCriteria();

                        if($id == null){
                                $id = Yii::app()->user->getId();
                        }

                        $criteria->with = array('pessoas');
                        $criteria->together = true;
                        $criteria->order = "situacao, t.nome";
                        $criteria->addCondition(
                                'pessoas.cod_pessoa = :cod_pessoa
                                 OR t.cod_pos_grad = :cod_pessoa
                                 OR t.cod_grad = :cod_pessoa
                                 OR t.cod_professor = :cod_pessoa', 'AND');
                        $criteria->params = array('cod_pessoa'=>$id);

                        return Projeto::model()->findAll($criteria);

                }
                /**
                 * Faz todo o cálculo do financeiro
                */

                 private function calcFinanceiro(){
                         $this->gasto_corrente = 0;
                         $this->gasto_comprometido = 0;
                         $this->saldo_corrente = 0;
                         $this->saldo_disponivel = 0;


                         foreach($this->receitas as $receita){

                                $this->verba_recebida += $receita->recebido;
                                $this->gasto_corrente += $receita->gasto_corrente;
                                $this->gasto_comprometido += $receita->gasto_comprometido;

                         }


                         //Saldos
                         $this->saldo_corrente = $this->verba_recebida - $this->gasto_corrente;
                         $this->saldo_disponivel = $this->verba_recebida - $this->gasto_comprometido;

                 }


                 /**
                  * Retorna o quanto foi orcamentado para data rubrica
                  * @param integer $cod_rubrica
                  * @return real
                  */
                 public function getOrcamentado($cod_rubrica){
                        $criteria = new CDbCriteria();
                        $criteria->compare('cod_rubrica', $cod_rubrica);
                        $criteria->compare('cod_projeto', $this->cod_projeto);
                        $criteria->select = "valor";

                        $orcamento = ProjetoOrcamento::model()->find($criteria);

                        if($orcamento == null){
                                return 0;
                        }

                        return $orcamento->valor;
                 }

                 /**
                  * Retorna todas as rubricas que te verba neste projeto
                  *  @return array
                  */
                 public function getRubricasComReceita(){

                        /*
                                                SELECT
                          rubrica.cod_rubrica,
                          rubrica.nome
                        FROM
                          public.rubrica,
                          public.projeto,
                          public.projeto_verba_rubrica,
                          public.projeto_verba
                        WHERE
                          projeto_verba_rubrica.cod_rubrica = rubrica.cod_rubrica AND
                          projeto_verba.cod_verba = projeto_verba_rubrica.cod_verba AND
                          projeto_verba.cod_projeto = projeto.cod_projeto AND
                          projeto.cod_projeto = 25;
                         */

                        $rubricas = array();
                        $result =  Yii::app()->db->createCommand()
                        ->select('rubrica.cod_rubrica')
                        ->from('rubrica, projeto, projeto_verba_rubrica, projeto_verba')
                        ->where("
                                        projeto_verba_rubrica.cod_rubrica = rubrica.cod_rubrica AND
                                        projeto_verba.cod_verba = projeto_verba_rubrica.cod_verba AND
                                        projeto_verba.cod_projeto = projeto.cod_projeto AND
                                        projeto.cod_projeto = :p;"
                                        , array(':p'=>$this->cod_projeto))
                        ->queryAll();

                        foreach($result as $r){
                                $rubricas[] = $r['cod_rubrica'];
                        }

                        return $rubricas;


                 }

                 public function getRubricas(){
                        $result =  Yii::app()->db->createCommand()
                        ->select('rubrica.cod_rubrica, rubrica.nome')
                        ->from('projeto_orcamento, rubrica')
                        ->where("projeto_orcamento.cod_projeto=:id AND projeto_orcamento.cod_rubrica = rubrica.cod_rubrica"
                                        , array('id'=>$this->cod_projeto))
                        ->queryAll();

                        return $result;
                 }

                 /**
                  * Retorna todas as rubricas que te verba neste projeto
                  *  @return array
                  */
                 public function getRubricasComOrcamento(){

                        /*
                         SELECT
                         rubrica.cod_rubrica,
                         rubrica.nome
                         FROM
                         public.rubrica,
                         public.projeto,
                         public.projeto_verba_rubrica,
                         public.projeto_verba
                         WHERE
                         projeto_verba_rubrica.cod_rubrica = rubrica.cod_rubrica AND
                         projeto_verba.cod_verba = projeto_verba_rubrica.cod_verba AND
                         projeto_verba.cod_projeto = projeto.cod_projeto AND
                         projeto.cod_projeto = 25;
                         */

                        $rubricas = array();
                        $result =  Yii::app()->db->createCommand()
                        ->select('rubrica.cod_rubrica')
                        ->from('rubrica, projeto, projeto_orcamento')
                        ->where("
                                        projeto_orcamento.cod_rubrica = rubrica.cod_rubrica AND
                                        projeto_orcamento.cod_projeto = projeto.cod_projeto AND
                                        projeto.cod_projeto = :p;"
                                        , array(':p'=>$this->cod_projeto))
                                        ->queryAll();

                        foreach($result as $r){
                                $rubricas[] = $r['cod_rubrica'];
                        }

                        return $rubricas;


                 }

        /*
         * Faz todo o cálculo do financeiro

        private function calcFinanceiro(){
                $this->gasto_corrente = 0;
                $this->gasto_comprometido = 0;
                $this->saldo_corrente = 0;
                $this->saldo_disponivel = 0;

                //Despesas
                foreach($this->despesas as $desp){
                        $this->gasto_comprometido += $desp->valor_comprometido;
                        $this->gasto_corrente += $desp->valor_corrente;
                }


                //Saldos
                $this->saldo_corrente = $this->verba_recebida - $this->gasto_corrente;
                $this->saldo_disponivel = $this->verba_recebida - $this->gasto_comprometido;

        }

        */

        /**
        *
        *       Verifica as permissoes do cadastradas no projeto,
        *       permissoes atribuidas no projeto e permissoes globais do sipesq
        *
        * @param $route - String - Rota da permissao
        * @param $id <opcional> - identificador de um usuário, se nulo pega o usuário logado
        */
        public function getPermition($route, $id=null){

                if (Yii::app()->user->isGuest) return 0;

                if ( $id == null ) $id = Yii::app()->user->getId();

                if ($id == $this->cod_professor) return 100; //Professor Responsável
                if ($id == $this->cod_grad) return 2; //Graduando Responsável
                if ($id == $this->cod_pos_grad) return 2; //Pós-Graduando Responsável



                $permissao_projeto = PermissaoProjeto::model()->findByPk(array('cod_pessoa'=>$id, 'cod_projeto'=>$this->cod_projeto));
                $permissao_sipesq = Sipesq::getPermition('projeto.' .$route, $id);

                //Não tem permissao neste projeto
                if ($permissao_projeto == null) return $permissao_sipesq;


                $permissao = 0;
                $routes = split('\.', $route);

                $perm_pessoa = json_decode($permissao_projeto->permissao);

                foreach($routes as $r){
                        if(property_exists($perm_pessoa, $r))
                                $perm_pessoa = $perm_pessoa->$r;
                        else
                         return -1; //Rota inexistente
                }

                if($perm_pessoa > $permissao)
                        $permissao = $perm_pessoa;



                return ($permissao_sipesq > $permissao) ? $permissao_sipesq : $permissao;
        }

        public function t($p){
            return $this-$p;
        }

}