<?php
define('ENTER', '
');
define('DIRSEP', DIRECTORY_SEPARATOR);

spl_autoload_register(function($file) {
    $sPath = App::getPathFull('app');
    if(strpos($file, 'Controller') === 0){
        $sFile = "{$sPath}Controller".DIRSEP."{$file}.php";
    }
    else if(strpos($file, 'Model') === 0){
        $sFile = "{$sPath}Model".DIRSEP."{$file}.php";
    }
    else if(strpos($file, 'Persistencia') === 0){
        $sFile = "{$sPath}View".DIRSEP."{$file}.php";
    }
    else if(strpos($file, 'View') === 0){
        $sFile = "{$sPath}View".DIRSEP."{$file}.php";
    }
    else{
        $sFile = "{$sPath}Util".DIRSEP."{$file}.php";
    }
    require_once $sFile;
});

function isEmpty($sValor){
    return trim($sValor) === '';
}

function defaultVal($sValor, $sPadrao){
    return isEmpty($sValor) ? $sPadrao : $sValor;
}
