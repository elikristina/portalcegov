<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PermissaoAcervoForm extends CFormModel
{
	public  $contatos
		,	$subscriptions
		,	$links
		,	$livros;


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('links, subscriptions, contatos, livors', 'required'),
			array('links, subscriptions, contatos, livors', 'numerical', 'integerOnly'=>true),
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
		$perm = new PermissaoAcervoForm();
		foreach($data as $key=>$val) $perm->$key = $val;
		return $perm;
	}
}