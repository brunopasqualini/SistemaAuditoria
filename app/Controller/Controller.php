<?php
namespace App\Controller;

abstract class Controller {

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

    protected function isAjax(){
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    protected function sendHeaders(){
        $sAccept = isset($_SERVER['HTTP_ACCEPT']) && !isEmpty(isset($_SERVER['HTTP_ACCEPT'])) ? $_SERVER['HTTP_ACCEPT'] : 'text/html';
        switch(true){
            case preg_match('/application\/json/', $sAccept):
                $this->sendHeadersAsJson();
                break;
            default:
                $this->sendHeadersAsHtml();
        }
    }

    protected function sendHeadersAsHtml(){
        header('Content-type: text/html; charset=utf-8');
    }

    protected function sendHeadersAsJson(){
        header('Content-type: application/json');
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
