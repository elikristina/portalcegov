<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class InstrumentoJuridico extends CFormModel
{
	public  $nro_inst_juridico
		,	$tipo_inst_juridico
		,	$unidade_admin_responsavel
		,	$gestao_repassadora
		,	$gestao_recebedora
		,	$data_assinatura
		,	$vigencia;


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('nro_inst_juridico, tipo_inst_juridico, unidade_admin_responsavel, gestao_recebedora, gestao_repassadora, data_assinatura' ,'safe'),
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
			'nro_inst_juridico'=>'Número do Instrumento Jurídico'
			, 'tipo_inst_juridico'=>'Tipo de Instrumento Jurídico'
			, 'unidade_admin_responsavel'=>'Unidade Administrativa Responsável'
			, 'gestao_recebedora'=>'U/G Gestão Recebedora'
			, 'gestao_repassadora'=>'U/G Gestão Recepassadora'
			, 'data_assinatura'=>'Data de Assinatura'
			, 'vigencia'=>'Vigência'
		);
	}
	
	public static function load($data){
		$perm = new InstrumentoJuridico();
		foreach($data as $key=>$val) $perm->$key = $val;
		return $perm;
	}
}