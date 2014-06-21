<?php
class UrlRulesHelper
{
    /**
     * @var array example array('moduleId'=>true)
     */
    protected static $_data = array();

    /**
     * import rules in UrlManager for name module
     * @param $moduleName
     */
    public static function import($moduleName)
    {
        if($moduleName && Yii::app()->hasModule($moduleName))
        {
            if (!isset(static::$_data[$moduleName]))
            {
                static::_addRules($moduleName);
                static::$_data[$moduleName] = true;
            }
        }
    }

    /**
     * import rules in UrlManager for app request
     * @param $beforeModules
     * @param $afterModules
     */
    public static function importRequest($beforeModules,$afterModules)
    {
        $modules=array_merge($beforeModules,array(static::_currentModuleName()),$afterModules);

        foreach ($modules as $module)
        {
            static::import($module);
        }
    }

    /**
     * @return string name current module
     */
    protected static function _currentModuleName()
    {
        $route = Yii::app()->getRequest()->getPathInfo();
        $domains = explode('/', $route);
        $moduleName = array_shift($domains);
        return $moduleName;
    }

    /**
     * addRules in UrlManager component
     * @param $moduleName
     */
    protected static function _addRules($moduleName)
    {
        $class = ucfirst($moduleName) . 'Module';
        Yii::import($moduleName . '.' . $class);
        if(method_exists($class, 'rules'))
        {
            $urlManager = Yii::app()->getUrlManager();
            $urlManager->addRules(call_user_func(array($class,'rules'),$moduleName));
        }
    }
}