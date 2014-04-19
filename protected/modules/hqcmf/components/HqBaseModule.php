<?php
class HqBaseModule extends CWebModule
{
    protected $_config;
    /**
     * Stores _shared assets path
     * @var string
     */
    protected $_shared; //var to store shared assets

    public function __construct($id,$parent,$config=null)
    {
        parent::__construct($id,$parent,$config);
        $this->_config=$config;
    }

    public function beforeControllerAction($controller, $action)
    {
        if(parent::beforeControllerAction($controller, $action))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getModuleViewFile($controller,$viewName)
    {
        return $controller->resolveViewFile($viewName,Yii::getPathOfAlias($this->id.'.themes.'.$this->theme.'.views').'/'.$controller->id,Yii::getPathOfAlias($this->id.'.themes.'.$this->theme.'.views'));
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function getShared()
    {
        return $this->_shared;
    }

    /**
     * Returns current core version
     * @return string
     */
    public function getVersionCMF()
    {
        return "0.1";
    }
}