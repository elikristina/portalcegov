<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	private $_id = null;
	private $_name = null;
	private $users=array(
			// username => password
			'admin'=>'AdmCegov',
		);


	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	 public function authenticate()
	{

		if(!isset($this->users[$this->username]))
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($this->users[$this->username]!==$this->password)
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		else
			$this->errorCode=self::ERROR_NONE;
		return !$this->errorCode;
	}

	/*
	 * 
	 * Autentica o usuário cmo o banco de dados utilizando as tabelas pessoa e user
			//obsoleto
			 public function autentica(){
			
			$connection=Yii::app()->db;
			$sql = "select * from pessoa, users where (password = :password AND email = :username) OR (password = :password AND username = :username)";
			$command = $connection->createCommand($sql);

			$command->bindParam(":username",$this->username,PDO::PARAM_STR);
			$command->bindParam(":password",md5($this->password),PDO::PARAM_STR);
			
			//Autentica
			if($command->execute() > 0 || $this->authenticate()){
				
				$this->errorCode=self::ERROR_NONE;
			}
			else $this->errorCode=self::ERROR_PASSWORD_INVALID;
						//Atribui os atributos
			   			$this->_name = $pessoa->email;
			   			$this->_id = $pessoa->cod_pessoa;
			   			
				return !$this->errorCode;
			} 
	 */

	/**
	 * 
	 * Autentica conforme o banco de dados - Atulização vinda do SIPESQ
	 */
	public function auth()
	{		//Se for admin a autenticação eh difernte
			if($this->username == 'admin')
				return $this->authenticate();

			//Carrega atributos do usuário
	   		$pessoa = new Pessoa();
	   		$pessoa = $pessoa->findForLogin($this->username);


		if($pessoa === null) //Verifica se o username é válido
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		else if($pessoa->password != md5($this->password)){ //Verifica se o pass é válido

			    $this->errorCode=self::ERROR_PASSWORD_INVALID;

	   			$this->_name = 	$this->username;
	   			$this->_id = $pessoa->cod_pessoa;
			}
		else{
				//Login foi bem sucedido
	   			$this->errorCode=self::ERROR_NONE;

	   			//Atribui os atributos
	   			$this->_name = $pessoa->email;
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