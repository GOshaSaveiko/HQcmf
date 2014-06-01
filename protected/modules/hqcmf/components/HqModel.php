<?php
class HqModel extends CActiveRecord
{
    public function getInstanceRelation($relation_id,$scenario='insert')
    {
        $relations=$this->relations();
        if (isset($relations[$relation_id]) && isset($relations[$relation_id][1]))
        {
            return new $relations[$relation_id][1]($scenario);
        }
        throw new CException('Not relation - '.$relation_id.' in class '.get_class($this));
    }
}