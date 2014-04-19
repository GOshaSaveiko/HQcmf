<?php
Yii::import('hqcmf.components.HqBaseModule');
class HQCmfModule extends HqBaseModule
{
    public $theme; //theme for module

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        $this->configureTheme();
        $this->layout = "/layouts/main";

        $mpath = Yii::getPathOfAlias('hqcmf.modules');
        YiiBase::setPathOfAlias('hqmodules', $mpath);
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

}