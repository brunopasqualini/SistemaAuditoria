<?php
namespace App\Model;

abstract class ModelAbstract implements \JsonSerializable {

    public function __call($sMethod, $aArguments){
        preg_match('/^([a-z]*)(.*)/', $sMethod, $aMatches);
        $sTypeMethod = $aMatches[1];
        $sProperty   = $aMatches[2];
        if(!isset($this->$sProperty)){
            $sProperty = lcfirst($sProperty);
        }
        if($sTypeMethod === 'set'){
            $this->$sProperty = $aArguments[0];
        }
        else if($sTypeMethod === 'get'){
            return $this->$sProperty;
        }
    }
    
    public static function getAll(ModelAbstract $oModel, $iChildLevel = 0){
        return RecordFactory::getInstance($oModel)->getAll($iChildLevel);
    }
    
    public function read($iChildLevel = 0){
        return RecordFactory::getInstance($this)->read($iChildLevel);
    }
    
    public function insert(){
        return RecordFactory::getInstance($this)->insert();
    }
    
    public function update(){
        return RecordFactory::getInstance($this)->update();
    }
    
    public function delete(){
        return RecordFactory::getInstance($this)->delete();
    }
    
    public function exists(){
        return RecordFactory::getInstance($this)->exists();
    }
    
    public function getPkComposition(){
        return RecordFactory::getInstance($this)->getPkComposition();
    }
    
}
