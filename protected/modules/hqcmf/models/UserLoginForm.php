<?php

/**
 * UserLoginForm class.
 * userLoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'CoreController'.
 */
class UserLoginForm extends CFormModel
{
	public $username;
	public $password;
	public $verifyCode;
	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		$rules=array(
			// username and password are required
			array('username, password', 'required'),
			// password needs to be authenticated
			array('password', 'authenticate'),
		);
        
        if(IsSet($_SESSION['logintry']) && $_SESSION['logintry']>=3)
        {
            $rules[]=array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd'));
        }
        
        return $rules;
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
               'username'=>'Login',
               'password'=>'Pass',
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		//if(empty($this->username) || $this->username == Hqh::t('LOGIN'))  $this->addError('username',Hqh::t('Please enter user name'));
		//if(empty($this->password) || $this->password == Hqh::t('PASSWORD')) $this->addError('password',Hqh::t('Please enter password'));
		if(IsSet($_SESSION['logintry']) && $_SESSION['logintry']>=3)
		{
		/*    
			if(empty($this->verifyCode)){
		    	$this->addError('verifyCode','Нет кода проверки');
			} elseif($this->verifyCode !== 'code') {
		    	$this->addError('verifyCode','Код проверки не совпадает');
		    }
		*/
		}
		$this->_identity=new HqUserIdentity($this->username,$this->password);
		if(!$this->_identity->authenticate())
			$this->addError('formerr',Hqh::t('Check the form is correct'));
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
               $this->_identity=new HqUserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===HqUserIdentity::ERROR_NONE)
		{
			//$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
			Yii::app()->getModule('hqcmf')->hquser->login($this->_identity,0); //0 вместо $duration
			return true;
		}
		else
			return false;
	}
}
