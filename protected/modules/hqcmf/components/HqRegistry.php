<?php
/**
 * Created by PhpStorm.
 * User: gosha
 * Date: 23.04.14
 * Time: 0:19
 * Registry reader/writer
 */

class HqRegistry
{
    
    /**
     * @var string stores model class name
     */
    public static $regmodel = "Registry";

    /**
     * Loads Redistry model
     * @param $key key to load model
     * @param bool $cancreate if true - will create new model if pk not found
     * @return Registry
     * @throws CHttpException
     */
    private static function loadModel($key, $createIfNotExists = false)
    {
        $regmodel = self::$regmodel;
        $model = $regmodel::model()->findByPk($key);
        if($model===null){
            if(!$createIfNotExists)
                throw new InvalidArgumentException('The requested key does not exist.');
            $model = new Registry();
        }
        return $model;
    }
    
    /**
     * Deletes key from storage
     * @param $key Key to delete from storage
     */
    public static function delete($key)
    {
        try {
            self::loadModel($key)->delete();
        } catch (InvalidArgumentException $e) {
            if(YII_DEBUG) throw $e;
            return false;
        }
        return true;
    }

    /**
     * Writes key and value to registry storage
     * @param $key Key to write
     * @param $value Value to write. If empty - key will be deleted
     */
    public static function write($key,$value)
    {
        if(empty($key))
            throw new InvalidArgumentException('The key not specified.');
        if(empty($value)){
            self::delete($key);
        } else {
            $model = self::loadModel($key,true);
            $model->r_key = $key;
            $model->r_value = $value;
            $model->save();
        }
        return true;
    }

    /**
     * Read value from registry storage by key
     * @param $key to read
     */
    public static function read($key)
    {
        $model = self::loadModel($key);
        return $model->r_value;
    }

    /**
     * Checks if key exists in registry
     * @param $key - key to check
     * @return bool
     */
    public static function check($key)
    {
        $check = self::loadModel($key,true);
        return (!$check->isNewRecord)?true:false;
    }
}