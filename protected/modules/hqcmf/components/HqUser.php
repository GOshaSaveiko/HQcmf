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
        if($this->getModel()){
            $user = $this->getModel();
            return $user->u_login;
        }
    }

    public function getMail()
    {
        if($this->getModel()){
            $user = $this->getModel();
            return $user->u_mail;
        }
    }

    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id);
        }
        return $this->_model;
    }
}