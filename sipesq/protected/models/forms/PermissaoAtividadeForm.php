<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class PermissaoAtividadeForm extends CFormModel
{
	public $informacoes;
	public $deletar;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('informacoes, deletar', 'required'),
			array('informacoes, deletar', 'numerical', 'integerOnly'=>true),
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
		$perm = new PermissaoAtividadeForm();
	
		foreach($data as $key=>$val){
			$perm->$key = $val;
		}
	
		return $perm;
	}
}