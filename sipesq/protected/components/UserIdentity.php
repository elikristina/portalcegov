<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_isAdmin = false;
	private $_id = null;
	private $_name = null;
	private $_fullname = null;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	/*
	public function authenticate()
	{	
		$users=array(
			// username => password
			'admin'=>'Adm#2011',
			'guisevero'=>'gorder',
		);
		if(!isset($users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else{
			$this->errorCode=self::ERROR_NONE;
		}
			
		return !$this->errorCode;
	}

	
public function autentica(){

	//se for o Administrador do sistema
	if($this->username == 'admin' || $this->username == 'guisevero')
		return $this->authenticate();

	$user = $this->username;
	$password = $this->password;
	$host = "ec-server";
	$domain = "ecepik.local";
	$basedn = "dc=ecepik,dc=local";
	$group = "EquipeCepik";
	try{
		$ds = ldap_connect("{$host}.{$domain}");
	}catch(CHttpException $e){
		throw $e(400,'Não foi possível conectar ao nosso servidor LDAP.');
	}
	
	ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
	ldap_set_option($ds, LDAP_OPT_REFERRALS, 0);
	
	if ($ds) {
		try{
	   		$r = @ldap_bind($ds, "{$user}@{$domain}", $password);
		}catch(CHttpException $e){
			throw $e(400,'Usuário ou Senha Inválidos');
		}
	   	if (!$r) {
	      $this->errorCode=self::ERROR_PASSWORD_INVALID;
	   	} else {
	   		
		   		//Carrega atributos do usuário
		   		$pessoa = new Pessoa();
		   		$pessoa = $pessoa->findByUserName($this->username);
		   		
		   		if($pessoa != null){
		   			
		   			$this->_name = $pessoa->nome_curto;
		   			$this->username = $pessoa->login;
		   			$this->_id = $pessoa->cod_pessoa;
		   		}
		   		
		      $this->errorCode=self::ERROR_NONE;
	   	}
	}
	return !$this->errorCode;
	}
	*/
	



	
	/**
	 * 
	 * Autentica o usuário conforme o banco de dados
	 * @return boolean
	 */
	public function auth()
	{		//Se for admin a autenticação eh difernte
			/*
			if($this->username == 'admin')
				return $this->authenticate();
			*/

			
			//Carrega atributos do usuário
	   		$pessoa = new Pessoa();
	   		$pessoa = $pessoa->findByUserName($this->username);
	   					
		
		if($pessoa === null) //Verifica se o username é válido
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($pessoa->password !== md5($this->password)){ //Verifica se o pass é válido

			    $this->errorCode=self::ERROR_PASSWORD_INVALID;
	   			
	   			$this->_name = $pessoa->login;
	   			$this->_id = $pessoa->cod_pessoa;
			}
		else{
				//Login foi bem sucedido
	   			$this->errorCode=self::ERROR_NONE;
	   			   			
	   			//Atribui os atributos
	   			$this->_name = $pessoa->nome;
	   			$this->_id = $pessoa->cod_pessoa;
	   			
		}

		return !$this->errorCode;
	}

	
	
	/**
	 * 
	 * Retorna o nome do usuário
	 * @return string $username
	 */
	
	public function getName(){
		return ($this->_name == null) ? $this->username : $this->_name;
	}
	
	/**
	 * 
	 * Retorna o nome do usuário
	 * @return string $id
	 */
	public function getId(){
		return ($this->_id != null) ? $this->_id : $this->username;	
	}
	
}