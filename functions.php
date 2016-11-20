<?php
ini_set('date.timezone', 'America/Sao_Paulo');

define('ENTER', '');
define('DIRSEP', DIRECTORY_SEPARATOR);

spl_autoload_register(function($sFile) {
    $sFile = getAbsolutePath() . $sFile . '.php';
    preg_replace('/^App/', 'app', $sFile);
    require_once $sFile;
});

set_exception_handler(function($oException) {
    ob_clean();
    $oViewException = new \App\View\ViewHandlerException();
    $oViewException->setDescricaoErro($oException->getMessage());
    $oViewException->render();
});

function isEmpty($sValor){
    return trim($sValor) === '';
}

function defaultVal($sValor, $sPadrao){
    return isEmpty($sValor) ? $sPadrao : $sValor;
}

function getClientIp(){
    return $_SERVER['REMOTE_ADDR'];
}

function currentDate(){
    return date('d/m/Y');
}

function currentTime(){
    return date('h:i:s');
}

function now(){
    return currentDate() . ' ' . currentTime();
}

function fileFromNamespaceExists($sClassName){
    $sFile = getAbsolutePath() . $sClassName . '.php';
    preg_replace('/^App/', 'app', $sFile);
    return file_exists($sFile);
}

function getRelativePath($sItem){
    return $sItem . '/';
}

function getAbsolutePath(){
    return __DIR__ . DIRSEP;
}

function getPathFull($sItem, $sDirSeparator = DIRSEP){
    return getAbsolutePath() . $sItem . $sDirSeparator;
}
