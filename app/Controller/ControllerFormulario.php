<?php
public class ControllerFormulario extends Controller {

    protected $Model;
    protected $Persistencia;
    protected $View;

    public function __construct(){
        parent::__construct();
        $this->View  = $this->getView();
        $this->Model = $this->getModel();
        $this->Persistencia = $this->getPersistencia();
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

    protected function getPersistencia(){
        $sPersistencia = 'Persistencia'.$this->_fileName;
        return new $sPersistencia();
    }

}
