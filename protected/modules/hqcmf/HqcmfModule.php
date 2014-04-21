<?php
Yii::import('hqcmf.components.HqBaseModule');

class HQCmfModule extends HqBaseModule
{


    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        parent::init();
        $this->layout = "/layouts/main";

        $mpath = Yii::getPathOfAlias('hqcmf.modules');
        YiiBase::setPathOfAlias('hqmodules', $mpath);
    }

}