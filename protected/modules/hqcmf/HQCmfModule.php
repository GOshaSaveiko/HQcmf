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
        // import the module-level models and components
        $this->setImport(array(
                $this->getId().'.models.*',
                $this->getId().'.components.*',
        ));

        Yii::app()->setComponents(array(
                'errorHandler' => array(
                        'errorAction' => 'hqcmf/core/error',
                ),
                'user' => array(
                    'class' => 'CMFUser',
                    'loginUrl'=>array('hqcmf/core/login'),
                ),
        ));
	

        //$this->modules = $this->buildModuleList();



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
     * Returns module list to generate menu
     * @return array
     */
    private function buildModuleList()
    {
        $list = array();
        /*
        //echo Yii::app()->user->rights;
        $rights = 255;//Yii::app()->user->rights
        $connection = Yii::app()->db;
        $command=$connection->createCommand('SELECT * FROM `cms_modules` WHERE `module_switch`=1 AND `module_rights`<='.$rights.' ORDER BY `module_order` ASC');
        $dataReader=$command->query();
        foreach($dataReader as $row)
        {
            $class = 'application.modules.'.$this->getId().'.modules.'.$row['module_name'].'.'.$row['module_name'].'Module';
            $dcont = $row['module_name'].'Module';
            $list[$row['module_name']] = array('class'=>$class,'defaultController'=>$dcont);
        }
        //print_r($list);
        */
        return $list;
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