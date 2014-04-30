<?php
class HqController extends CController
{
    public $layout="";

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('login','captcha','error'),
                'users'=>array('*'),
            ),
            array('allow',
                'users'=>array('@'),
//                'roles'=>array('administrator'),
            ),
            array('allow',
                'users'=>array('@'),
                'controllers'=>array('core'),
               // 'actions'=>array('error','logout'),
                'roles'=>array('user','guest'),
            ),
            array('deny',
                'users'=>array('*'),
            ),
        );
    }


    /*
    public function getViewFile($viewName)
    {
        if(($theme=Yii::app()->getTheme())!==null && ($viewFile=$theme->getViewFile($this,$viewName))!==false)
            return $viewFile;
        $moduleViewPath=$basePath=Yii::app()->getViewPath();
        if(($module=$this->getModule())!==null)
        {
            if ((isset($module->theme) && $module->theme!==null) && ($viewFile=$module->getModuleViewFile($this,$viewName))!==false)
            {
                return $viewFile;
            }
            $moduleViewPath=$module->getViewPath();
        }
        return $this->resolveViewFile($viewName,$this->getViewPath(),$basePath,$moduleViewPath);
    }
    */
    public function getLayoutFile($layoutName)
    {
        if($layoutName===false)
            return false;
        if(($theme=Yii::app()->getTheme())!==null && ($layoutFile=$theme->getLayoutFile($this,$layoutName))!==false)
            return $layoutFile;

        if(empty($layoutName))
        {
            $module=$this->getModule();
            while($module!==null)
            {
                if($module->layout===false)
                    return false;
                if(!empty($module->layout))
                    break;
                $module=$module->getParentModule();
            }
            if($module===null)
                $module=Yii::app();
            $layoutName=$module->layout;
        }
        elseif(($module=$this->getModule())===null)
            $module=Yii::app();

        if (isset($module->theme) && $module->theme!==null)
        {
            return $this->resolveViewFile($layoutName,Yii::getPathOfAlias($module->id.'.themes.'.$module->theme.'.views'),Yii::getPathOfAlias($module->id.'.themes.'.$module->theme.'.views'));
        }

        return $this->resolveViewFile($layoutName,$module->getLayoutPath(),Yii::app()->getViewPath(),$module->getViewPath());
    }
}