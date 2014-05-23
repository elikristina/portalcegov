<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class Convenio extends CFormModel
{
	public  $nro_convenio
		,	$titulo
		,	$protocolo_convenio
		,	$data_assinatura
		,	$vigencia
		,	$protocolo_financeiro
		,	$nome_proplan
		,	$portal_siconv
		,	$tipo_inst_juridico
		,	$cod_projeto_faufrgs
		,	$fundacao_apoio
		,	$previsao_termino;


	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('nro_convenio, tipo_inst_juridico, titulo, protocolo_financeiro, protocolo_convenio, data_assinatura, vigencia, cod_projeto_faufrgs, portal_siconv, nome_proplan, previsao_termino' ,'safe'),
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
			'nro_convenio'=>'Número do Convênio'
			, 'fundacao_apoio'=>'Fundação de Apoio'
			, 'tipo_inst_juridico'=>'Tipo de Instrumento Jurídico'
			, 'titulo'=>'Título do Convênio'
			, 'protocolo_convenio'=>'Protocolo do Convênio'
			, 'data_assinatura'=>'Data da Assinatura'
			, 'vigencia'=>'Vigencia'
			, 'protocolo_financeiro'=>'Portocolo Financeiro'
			, 'portal_siconv'=>'Portal SICONV'
			, 'cod_projeto_faufrgs'=>'Código do Projeto na Fundação de Apoio'
			, 'nome_proplan'=>'Nome na Proplan'
			, 'vigencia'=>'Vigência (em meses)'
			, 'previsao_termino'=>'Previsão do Término da Vigência'
		);
	}
	
	public static function load($data){
		
		$perm = new Convenio();
		foreach($data as $key=>$val) $perm->$key = $val;
		return $perm;
	}
}