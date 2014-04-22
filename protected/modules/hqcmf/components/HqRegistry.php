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
     * Loads Redistry model
     * @param $key key to load model
     * @param bool $cancreate if true - will create new model if pk not found
     * @return Registry
     * @throws CHttpException
     */
    private function loadModel($key,$cancreate = false)
    {
        $model = Registry::model()->findByPk($key);
        if($model===null){
            if(!$cancreate)
                throw new CHttpException('The requested key does not exist.');
            $model = new Registry();
        }
        return $model;
    }
    
    /**
     * Deletes key from storage
     * @param $key Key to delete from storage
     */
    private function delete($key)
    {
        $this->loadModel($key)->delete();
        return true;
    }

    /**
     * Writes key and value to registry storage
     * @param $key Key to write
     * @param $value Value to write. If empty - key will be deleted
     */
    public function write($key,$value)
    {
        if(empty($key))
            throw new CHttpException('The key not specified.');
        if(empty($value)){
            $this->delete($key);
        } else {
            $model = $this->loadModel($key,true);
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
    public function read($key)
    {
        $model = $this->loadModel($key);
        return $model->r_value;
    }
}