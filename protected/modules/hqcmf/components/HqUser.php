<?php
/**
 * Description of HqUser
 *
 * @author GOsha
 */
class HqUser extends CWebUser {
    private $_model = null;

    protected $_roles;

    public function getLogin()
    {
        if(($user=$this->getModel())!==null){
            return $user->u_login;
        }
    }

    public function getMail()
    {
        if(($user=$this->getModel())!==null){
            return $user->u_mail;
        }
    }

    public function getRoles($reset=false)
    {
        if ($reset || $this->_roles===null)
        {
            $this->_roles=$this->getModel()->getRoles();
        }
        return $this->_roles;
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = UserModel::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}