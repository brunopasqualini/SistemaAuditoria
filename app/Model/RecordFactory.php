<?php
namespace App\Model;

class RecordFactory {
    
    private static $records = [];
    
    public static function getInstance(ModelAbstract $oModel){
        return self::getRecord($oModel);
    }
    
    private static function getRecord(ModelAbstract $oModel){
        foreach (self::$records as $aInfoRecord) {
            if($aInfoRecord[0] === $oModel){
                return $aInfoRecord[1];
            }
        }
        $aInfoRecord     = [$oModel, new Record($oModel)];
        self::$records[] = $aInfoRecord;
        return $aInfoRecord[1];
    }
    
}