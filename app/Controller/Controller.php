<?php
abstract class Controller {

    protected $App;

    protected $_fileName;

    public function __construct(){
        $this->app = App::getInstance();
        $this->extractName();
    }

    abstract public function processa();

    protected function extractName(){
        $this->_fileName = str_replace(__CLASS__, '', get_class($this));
    }
    
}
