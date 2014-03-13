<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class EnderecoResidencial extends CFormModel
{
        public  $cod_endereco
                ,        $cod_pessoa
                ,        $logradouro
                ,        $numero
                ,        $complemento
                ,        $bairro
                ,        $cidade
                ,        $tipo
                ,        $cep
                ,        $pais
                ,        $estado;


        /**
         * Declares the validation rules.
         */
        public function rules()
        {
                return array(
                        array('cod_endereco, cod_pessoa, logradouro, numero, bairro, cidade, tipo, cep, pais, estado', 'required'),
                );
        }

        /**
         * Declares customized attribute labels.
         * If not declared here, an attribute would have a label that is
         * the same as its name with the first letter in upper case.
         */
        public function attributeLabels()
        {
                return array(
                        'logradouro'=>'Logradouro', 
                        'numero'=>'Número',
                        'bairro'=>'Bairro', 
                        'cidade'=>'Cidade', 
                        'tipo'=>'Tipo', 
                        'cep'=>'CEP', 
                        'pais'=>'País', 
                        'estado'=>'Estado'
                );
        }
        
        public static function load($data){
                $perm = new EnderecoResidencial();
                foreach($data as $key=>$val) $perm->$key = $val;
                return $perm;
        }
}