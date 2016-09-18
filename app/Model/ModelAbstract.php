<?php
namespace App\Model;

abstract class ModelAbstract extends Record {

    public function __call($sMethod, $aArguments){
        preg_match('/^([a-z]*)(.*)/', $sMethod, $aMatches);
        $sTypeMethod = $aMatches[1];
        $sProperty   = strtolower($aMatches[2]);
        if($sTypeMethod === 'set'){
            $this->$sProperty = $aArguments[0];
        }
        else if($sTypeMethod === 'get'){
            return $this->$sProperty;
        }
    }

}
