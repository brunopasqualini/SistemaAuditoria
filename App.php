<?php

use App\Core\Session;
use App\Core\Config;
use App\Core\Database\Connection;

class App {

    private static $_self;

    public $Config;
    public $DB;

    private $_params = [];

    private function __construct(){
        $this->parseParams();
    }

    public static function getInstance(){
        if(!isset(self::$_self)){
            self::$_self = new App();
        }
        return self::$_self;
    }

    public function init() {
        $this->Config = Config::load(['config']);
        $this->DB     = Connection::get();
        Session::init(Session::DATABASE);
        $this->dispatch();
    }

    private function dispatch(){
        $sController = $this->getParam('path',    'index');
        $sProcess    = $this->getParam('process', 'processa');
        if(!file_exists("Controller".DIRSEP."Controller{$sController}.php")){
            $sController = 'ControllerIndex';
        }
        $sController = 'App\Controller\\' . $sController;
        $oController = new $sController();
        if(!method_exists($oController, $sProcess)){
            $sProcess = 'processa';
        }
        $oController->$sProcess();
    }

    public function getParam($sParam, $xDefault = null){
        return isset($this->_params[$sParam]) ? $this->_params[$sParam] : $xDefault;
    }

    private function parseParams(){
        foreach($_REQUEST as $sParam => $sValor){
            $this->_params[$sParam] = $sValor;
        }
    }

    public static function getPath($item){
        return $item . DIRSEP;
    }

    public static function getPathRoot(){
        return __DIR__ . DIRSEP;
    }

    public static function getPathFull($item){
        return self::getPathRoot() . $item . DIRSEP;
    }

    public static function getPathTemp(){
        return self::getPathFull('temp') . DIRSEP;
    }

}
