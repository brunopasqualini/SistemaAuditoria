<?php
namespace App\Controller;

class ControllerFormulario extends Controller {

    protected $Model;
    protected $Persistence;
    protected $View;

    public function __construct(){
        parent::__construct();
        $this->View  = $this->getView();
        $this->Model = $this->getModel();
        $this->Persistencia = $this->getPersistence();
    }

    public function processa(){

    }

    protected function getView(){
        $sView = 'View'.$this->_fileName;
        return new $sView();
    }

    protected function getModel(){
        $sModel = 'Model'.$this->_fileName;
        return new $sModel();
    }

    protected function getPersistence(){
        $sPersistence = 'Persistence'.$this->_fileName;
        return new $sPersistence();
    }

}
