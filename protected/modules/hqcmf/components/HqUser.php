<?php
/**
 * Description of HqUser
 *
 * @author GOsha
 */
class HqUser extends CWebUser {
    private $_model = null;

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

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = UserModel::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}