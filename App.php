<?php

use App\Core\Session;
use App\Core\Config;
use App\Controller\Controller;
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
        $sPath       = $this->getParam('path',    'index');
        $sProcess    = $this->getParam('process', 'process');
        $sController = Controller::getControllerFromName(ucfirst($sPath));
        if(!fileFromNamespaceExists($sController)){
            $sController = Controller::getControllerFromName('Index');
        }
        $oController = new $sController();
        if(!method_exists($oController, $sProcess)){
            $sProcess = 'process';
        }
        $oController->$sProcess();
    }

    public function redirect($sLocation){
        $sUrlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        header('Location: ' . $sUrlPath . $sLocation);
        die;
    }

    public function getParam($sParam, $xDefault = null){
        return isset($this->_params[$sParam]) ? trim($this->_params[$sParam]) : $xDefault;
    }

    private function parseParams(){
        foreach($_REQUEST as $sParam => $sValor){
            $this->_params[$sParam] = $sValor;
        }
    }

}
