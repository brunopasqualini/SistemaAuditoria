<?php
namespace App\Controller;

abstract class Controller {

    protected $App;

    protected $_fileName;

    public function __construct(){
        $this->App = \App::getInstance();
        $this->extractName();
        $this->sendHeaders();
    }

    abstract public function processa();

    private function sendHeaders(){
        header('Content-type: text/html; charset=utf-8');
    }

    protected function extractName(){
        $this->_fileName = str_replace(__CLASS__, '', get_class($this));
    }

}
