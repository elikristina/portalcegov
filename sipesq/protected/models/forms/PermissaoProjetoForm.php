<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PermissaoProjetoForm extends CFormModel
{
	public $informacoes;
	public $financeiro;
	public $atividades;
	public $deletar;
	public $gerencial;
	public $documentos;
	public $rubricas;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('informacoes, financeiro, atividades, deletar, gerencial, documentos', 'required'),
			array('informacoes, financeiro, atividades, deletar, gerencial, documentos', 'numerical', 'integerOnly'=>true),
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
			'informacoes'=>'Informações',
			'deletar'=>'Deleção'
		);
	}
	
	public static function load($data){
		$perm = new PermissaoProjetoForm();
		foreach($data as $key=>$val) $perm->$key = $val;
		return $perm;
	}
}