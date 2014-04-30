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
    public $remember_me;
	public $verify_code;
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

        if(IsSet(Yii::app()->user->viewCaptcha))
        {
            $rules[]=array('verify_code', 'captcha', 'allowEmpty'=>!extension_loaded('gd'));
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
			$duration=$this->remember_me ? 3600*24*30 : 0; // 30 days
			Yii::app()->user->login($this->_identity,$duration); //0 вместо $duration
			return true;
		}
		else
			return false;
	}
}
