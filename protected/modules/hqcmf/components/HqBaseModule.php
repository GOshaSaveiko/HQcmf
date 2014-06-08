<?php
class HqBaseModule extends CWebModule
{
    protected $_config;
    /**
     * Stores _shared assets path
     * @var string
     */
    protected $_shared; //var to store shared assets
    /**
    * Storres current theme value from hqcmf.php
    * @var string
    */
    public $theme; //theme for module

    public function __construct($id,$parent,$config=null)
    {
        parent::__construct($id,$parent,$config);

        $this->_config=$config;

        if (isset($this->_config['components']['hquser']))
        {
            Yii::app()->setComponent('user',$this->_config['components']['hquser']);
        }

        if (isset($this->_config['components']['authManager']))
        {
            Yii::app()->setComponent('authManager',$this->_config['components']['authManager']);
        }

        Yii::app()->setComponent('errorHandler',array('errorAction'=>'hqcmf/core/error'));
    }

    public function init()
    {
        $this->configureTheme();
    }

    public function beforeControllerAction($controller, $action)
    {
        if(!parent::beforeControllerAction($controller, $action))
        {
            return false;
        }
        return true;
    }

    protected function configureTheme()
    {
        $theme=($this->theme===null) ? '' : '.themes.'.$this->theme;

        $ad = Yii::getPathOfAlias('hqcmf'.$theme.'.assets');
        if(file_exists($ad))
        {
            $am = Yii::app()->assetManager;
            $this->_shared = $am->publish($ad);
        } else {
            $this->_shared = null;
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