<?php
namespace App\Model;

use \App\Controller\ControllerUserSession;

abstract class ModelAbstract implements \JsonSerializable {

    public function __call($sMethod, $aArguments){
        preg_match('/^([a-z]*)(.*)/', $sMethod, $aMatches);
        $sTypeMethod = $aMatches[1];
        $sProperty   = $aMatches[2];
        if(!property_exists($this, $sProperty)){
            $sProperty = lcfirst($sProperty);
        }
        if(property_exists($this, $sProperty)){
            if($sTypeMethod === 'set'){
                $this->$sProperty = $aArguments[0];
            }
            else if($sTypeMethod === 'get'){
                return $this->$sProperty;
            }
        }
    }
    
    public static function getAll(ModelAbstract $oModel, $iChildLevel = 0){
        return RecordFactory::getInstance($oModel)->getAll($iChildLevel);
    }
    
    public static function getAllWithCondition(ModelAbstract $oModel, $aCondition, $aValues, $iChildLevel = 0){
        return RecordFactory::getInstance($oModel)->getAllWithCondition($aCondition, $aValues, $iChildLevel);
    }
    
    public function read($iChildLevel = 0){
        return RecordFactory::getInstance($this)->read($iChildLevel);
    }
    
    public function insert(){
        $this->logModel('Inseriu o registro', $this->jsonSerialize(), []);
        return RecordFactory::getInstance($this)->insert();
    }
    
    public function update(){
        $sClass   = get_class($this);
        $oCurrent = new $sClass();
        foreach($this->getPkComposition() as $sProperty => $aInfo) {
            Bean::set($sProperty, Bean::get($sProperty, $this), $oCurrent);
        }
        $oCurrent->read();
        $this->logModel('Alterou o registro', $this->jsonSerialize(), $oCurrent->jsonSerialize());
        return RecordFactory::getInstance($this)->update();
    }
    
    public function delete(){
        $this->logModel('Excluiu o registro', $this->jsonSerialize(), []);
        return RecordFactory::getInstance($this)->delete();
    }
    
    public function exists(){
        return RecordFactory::getInstance($this)->exists();
    }
    
    public function getPkComposition(){
        return RecordFactory::getInstance($this)->getPkComposition();
    }
    
    private function getTable(){
        return RecordFactory::getInstance($this)->getTable();
    }
    
    protected function logModel($sDescricao, $aDadoAtual, $aDadoAnterior){
        if(!ControllerUserSession::isAuth()){
            return;
        }
        $oLogs = new ModelLogs();
        $oLogs->setUsuario(ControllerUserSession::getUser());
        $oLogs->setDataHora(now());
        $oLogs->setIp(getClientIp());
        $oLogs->setTabela($this->getTable());
        $oLogs->setDadoAtual(json_encode($aDadoAtual));
        $oLogs->setDadoAnterior(json_encode($aDadoAnterior));
        $oLogs->setDescricao($sDescricao);
        $oLogs->insert();
    }
    
}
