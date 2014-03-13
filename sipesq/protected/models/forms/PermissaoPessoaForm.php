<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PermissaoPessoaForm extends CFormModel
{
	public $informacoes;
	public $informacoes_avancadas;
	public $financeiro;
	public $atividades;
	public $deletar;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('informacoes, financeiro, atividades, informacoes_avancadas deletar', 'required'),
			array('informacoes, financeiro, atividades, informacoes_avancadas deletar', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 * public $informacoes;
	public $informacoes_avancadas;
	public $financeiro;
	public $atividades;
	public $deletar;
	 */
	public function attributeLabels()
	{
		return array(
			'informacoes'=>'Acesso as Informações Básicas',
			'informacoes_avancadas'=>'Acesso as Informações Avançadas',
			'deletar'=>'Deletar um Usuário',
			'atividades'=>'Acesso as Atividades',
			'financeiro'=>'Acessso ao Financeiro'
			
		);
	}
	
	public static function load($data){
		$perm = new PermissaoPessoaForm();
		
		foreach($data as $key=>$val){
			$perm->$key = $val;
		}
		
		return $perm;
	}
}