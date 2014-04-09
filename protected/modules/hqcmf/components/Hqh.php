<?php
/**
 * HQCmf Yii adapter
 * this is CMS Yii adapter
 * @author GOshaSaveiko
 */
class HQh extends HQCmfModule
{
    /**
     * CMF translator. Core message source
     * @param string $message 
     * @param array $trans
     * @return string 
     */
    public static function t($message,$trans=array())
    {
       return Yii::t('HQCmfModule.core',$message,$trans);
    }

    /**
     * CMF Modules translator. Local message source
     * @param string $message
     * @param array $trans
     * @return string 
     */
    public static function mt($message,$trans=array())
    {
        return Yii::t(Yii::app()->controller->id.'.trans',$message,$trans);
    }

    /**
     * Switch image for CMF
     * @param bool $data
     * @return string html
     */
    public static function getSwitch($data)
    {
        $img = ($data)?"on":"off";
        $out = CHtml::image(Yii::app()->controller->module->shared.'/img/'.$img.'20.png', self::t($img), array('title'=>self::t($img)));
        return $out;
    }

    public static function rmDirRec($dir)
    {
        $objs = glob($dir."/*");
        if ($objs)
        {
            foreach($objs as $obj)
            {
                is_dir($obj) ? self::rmDirRec($obj) : @unlink($obj);
            }
        }
        @rmdir($dir);
    }


}
?>
