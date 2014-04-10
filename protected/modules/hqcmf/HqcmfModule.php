<?php
class HQCmfModule extends CWebModule
{
    /**
     * Stores shared assets path
     * @var string
     */
    private $shared; //var to store shared assets

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        $this->layout = "/layouts/main";

        $ad = Yii::getPathOfAlias('application.modules.hqcmf.assets');
        if(file_exists($ad))
        {
            $am = Yii::app()->assetManager;
            $this->shared = $am->publish($ad);
        } else {
            $this->shared = null;
        }

        $mpath = Yii::getPathOfAlias('application.modules.hqcmf.modules');
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

     /**
     * Returns current core version
     * @return string
     */
    public function getVer()
    {
        return "0.1";
    }

}