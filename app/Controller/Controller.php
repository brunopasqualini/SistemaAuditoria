<?php
namespace App\Controller;

abstract class Controller {

    const ACTION_INSERT   = 'insert';
    const ACTION_UPDATE   = 'update';
    const ACTION_DELETE   = 'delete';
    const ACTION_READ     = 'read';
    const ACTION_GRIDVIEW = 'gridview';

    protected $App;

    public function __construct(){
        $this->App = \App::getInstance();
        $this->sendHeaders();
    }

    abstract public function process();

    protected function getPath(){
        return $this->App->getParam('path');
    }

    protected function getProcess(){
        return $this->App->getParam('process');
    }

    protected function getAction(){
        return $this->App->getParam('action');
    }

    protected function isGet(){
        return $_SERVER['REQUEST_METHOD'] === 'GET';
    }

    protected function isPost(){
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    protected function sendHeaders(){
        header('Content-type: text/html; charset=utf-8');
    }

    public static function getControllerFromName($sName){
        $sName    = ucfirst($sName);
        $sPreffix = '\App\Controller\Controller';
        if(preg_match('/^Form/', $sName, $aMatches)){
            if(!fileFromNamespaceExists($sPreffix . $sName)){
                $sName = 'Form';
            }
        }
        else if(preg_match('/^Grid/', $sName, $aMatches)){
            if(!fileFromNamespaceExists($sPreffix . $sName)){
                $sName = 'Grid';
            }
        }
        return $sPreffix . ucfirst($sName);
    }

}
