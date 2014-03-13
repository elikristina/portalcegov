<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class NewLoginForm extends CFormModel
{
	public $name;
	public $login;
	public $password;
	public $password_confirm;
	public $old_password;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('old_password','validaSenha'),
			array('old_password, password, password_confirm', 'required'),
            array('old_password, password, password_confirm', 'length', 'min'=>6, 'max'=>40),
            array('password_confirm', 'compare', 'compareAttribute'=>'password', 'message'=>'Nova Senha e Confirmação de Nova Senha devem ser iguais.'),
			
			
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'password'=>'Nova Senha',
			'old_password'=>'Senha Atual',	
			'password_confirm'=>'Confirmação de Nova Senha',
			'login'=>'Nome de Usuário',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function validaSenha($attribute,$params)
	{
				$pessoa = Pessoa::model()->findByPk(Yii::app()->user->getId());
				if($pessoa->password !== md5($this->$attribute)){
					$this->addError($attribute,'Sua senha antiga não confere');
					return false;
				}
					
	}

	public function __construct($model=null) {
       parent::__construct();
       
       if($model != null){
       	$this->login = $model->login;
       	$this->name = $model->nome;
       }
   }
	
}
