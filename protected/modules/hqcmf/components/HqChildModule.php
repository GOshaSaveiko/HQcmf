<?php
class HqChildModule extends HqBaseModule
{
    public function init()
    {
        parent::init();

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