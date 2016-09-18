<?php
namespace App\Core;

class Config {

    private $info = [];

    private function __construct(){}

    public static function load(Array $aFiles){
        $oConfig = new Config();
        foreach($aFiles as $sFile){
            $oConfig->parseFile($sFile);
        }
        return $oConfig;
    }

    private function parseFile($sName){
        $sPath = getAbsolutePath() . $sName . '.ini';
        $aInfo = parse_ini_file($sPath, true, INI_SCANNER_TYPED);
        foreach ($aInfo as $sSection => $aConfig) {
            if(count($aConfig) > 0){
                $this->info[$sSection] = $aConfig;
            }
        }
    }

    public function getConfig($sContext, $sKey = null){
        if(!isset($this->info[$sContext])){
            throw new \Exception("Context {$sContext} not found!");
        }
        if(is_null($sKey)){
            return $this->info[$sContext];
        }
        if(!isset($this->info[$sContext][$sKey])){
            throw new \Exception("Config {$sKey} from context {$sContext} not found!");
        }
        return $this->info[$sContext][$sKey];
    }

}
