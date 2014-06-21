<?php
class AppBehavior extends CBehavior
{
    public $beforeCurrentModule = array();
    public $afterCurrentModule = array();

    public function events()
    {
        return array_merge(parent::events(),
                           array(
                           'onBeginRequest'=>'beginRequest',
                           )
                );
    }

    public function beginRequest($event)
    {
        UrlRulesHelper::importRequest($this->beforeCurrentModule,$this->afterCurrentModule);
    }
}