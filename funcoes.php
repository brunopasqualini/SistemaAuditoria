<?php
define('ENTER', '
');
define('DIRSEP', DIRECTORY_SEPARATOR);

spl_autoload_register(function($file) {
    $sFile = App::getPathRoot() . $file . '.php';
    preg_replace('/^App/', 'app', $sFile);
    require_once $sFile;
});

function isEmpty($sValor){
    return trim($sValor) === '';
}

function defaultVal($sValor, $sPadrao){
    return isEmpty($sValor) ? $sPadrao : $sValor;
}
