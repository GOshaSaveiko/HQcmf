<?php
/**
 * HQCmf Yii adapter
 * this is CMS Yii adapter
 * @author GOshaSaveiko
 */
class HQh extends HqcmfModule
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
