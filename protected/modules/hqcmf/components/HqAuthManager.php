<?php
class HqAuthManager extends CPhpAuthManager
{
    public function init()
    {
        parent::init();
    }

    public function checkAccess($itemName,$userId,$params=array())
    {
        return true;
    }
}
?>
