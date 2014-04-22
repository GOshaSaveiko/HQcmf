<?php
class HqChildModule extends HqBaseModule
{
    public function __construct($id,$parent,$config=null)
    {
        parent::__construct($id,$parent,$config);
        $this->_config=$config;
    }

    public function init()
    {
        parent::init();
        if ($this->defaultController=='default')
        {
            $this->defaultController='Core';
        }

        $parent_config=$this->parentModule->getConfig();
        if (isset($parent_config['components']))
        {
            $this->setComponents(
                CMap::mergeArray($parent_config['components'],
                                $this->getComponents()
                )
            );
        }
    }
}