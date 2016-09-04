<?php
namespace App\Model;

class Bean {

    const METHOD_SET = 'set';
    const METHOD_GET = 'get';

    private static function callMethod($sTypeMethod, $sProperty, $sValue, $oModel){
        $aProperties = explode('.', $sProperty);
        $sProperty   = $aProperties[count($aProperties) - 1];
        for($i = 0; $i < count($aProperties) - 1; $i++){
            $oModel = self::get($aProperties[$i], $oModel);
        }
        $sMethod = $sTypeMethod . ucfirst($sProperty);
        if($sTypeMethod == self::METHOD_GET){
            return $oModel->$sMethod();
        }
        $oModel->$sMethod($sValue);
    }

    public static function get($sProperty, $oModel){
        return self::callMethod(self::METHOD_GET, $sProperty, null, $oModel);
    }

    public static function set($sProperty, $sValue, $oModel){
        self::callMethod(self::METHOD_SET, $sProperty, $sValue, $oModel);
    }

}
