<?php
namespace App\Core;

class Config {

    private $info = [];

    private function __construct(){}

    public static function load(Array $files){
        $oConfig = new Config();
        foreach($files as $file){
            $oConfig->parseFile($file);
        }
        return $oConfig;
    }

    private function parseFile($name){
        $sPath = \App::getPathRoot() . $name . '.ini';
        $aInfo = parse_ini_file($sPath, true, INI_SCANNER_TYPED);
        foreach ($aInfo as $section => $aConfig) {
            if(count($aConfig) > 0){
                $this->info[$section] = $aConfig;
            }
        }
    }

    public function getConfig($subject, $key = null){
        if(!isset($this->info[$subject])){
            throw new \Exception('Section not found!');
        }
        if(is_null($key)){
            return $this->info[$subject];
        }
        if(!isset($this->info[$subject][$key])){
            throw new \Exception("Config {$key} from section {$subject} not found!");
        }
        return $this->info[$subject][$key];
    }

}
