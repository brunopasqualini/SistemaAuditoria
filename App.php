<?php
class App {

    private static $_self;

    private $_params = [];

    private function __construct(){
        $this->parseParams();
        Sessao::init(Sessao::DATABASE);
    }

    public static function getInstance(){
        if(!isset(self::$_self)){
            self::$_self = new App();
        }
        return self::$_self;
    }

    public function init() {
        $this->dispatch();
    }

    private function dispatch(){
        $sController = $this->getParam('path',    'index');
        $sProcess    = $this->getParam('process', 'processa');
        if(!file_exists("Controller".DIRSEP."Controller{$sController}.php")){
            $sController = 'ControllerIndex';
        }
        $oController = new $sController();
        if(!method_exists($oController, $sProcess)){
            $sProcess = 'processa';
        }
        $oController->$sProcess();
    }

    public function getParam($sParam, $sDefault = null){
        return isset($this->_params[$sParam]) ? $this->_params[$sParam] : $sDefault;
    }

    private function parseParams(){
        foreach($_REQUEST as $sParam => $sValor){
            $this->_params[$sParam] = $sValor;
        }
    }

    public static function getPath($item){
        return $item . DIRSEP;
    }

    public static function getPathFull($item){
        return __DIR__ . DIRSEP . $item . DIRSEP;
    }
    
}
