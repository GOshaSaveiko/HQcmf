<?php
class HQCmfModule extends CWebModule
{
    public $theme; //theme for module

    /**
     * Stores _shared assets path
     * @var string
     */
    private $_shared; //var to store shared assets


    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        $this->configureTheme();

        $this->layout = "/layouts/main";

        $mpath = Yii::getPathOfAlias('hqcmf.modules');
        YiiBase::setPathOfAlias('modules', $mpath);
    }

    public function beforeControllerAction($controller, $action) {
        if(parent::beforeControllerAction($controller, $action))
        {
            //$controller->pageTitle = Mii::t('HQCmf v{version} Content Management Framework',array('{version}'=>CmsModule::getVer())).' - ';
            return true;
        } else {
            return false;
        }
    }

    public function getShared()
    {
        return $this->_shared;
    }

    protected function configureTheme()
    {
        $theme=($this->theme===null) ? '' : '.themes.'.$this->theme;

        $this->setViewPath(Yii::getPathOfAlias('hqcmf'.$theme.'.views'));
        $ad = Yii::getPathOfAlias('hqcmf'.$theme.'.assets');
        if(file_exists($ad))
        {
            $am = Yii::app()->assetManager;
            $this->_shared = $am->publish($ad);
        } else {
            $this->_shared = null;
        }
    }

     /**
     * Returns current core version
     * @return string
     */
    public function getVer()
    {
        return "0.1";
    }

}