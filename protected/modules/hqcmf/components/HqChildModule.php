<?php
class HqChildModule extends HqBaseModule
{
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