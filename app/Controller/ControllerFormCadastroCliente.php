<?php

namespace App\Controller;

use App\Model\ModelCliente;
use App\Model\ModelUsuario;

class ControllerFormCadastroCliente extends ControllerForm {
    
    /**
     * @var \App\Model\ModelUsuario
     */
    protected $ModelUsuario;
    
    public function __construct() {
        parent::__construct();
        $this->ModelUsuario = new \App\Model\ModelUsuario();
    }

    protected function checkLogin() {
        return false;
    }

    public function process() {
        if($this->isGet()){
            $this->renderView();
            return;
        }
        $this->setViewValuesFromRequest();
        //CLIENTE
        $this->Model->setNome($this->View->getForm()->getField('nome')->getValue());
        $this->Model->setEndereco($this->View->getForm()->getField('endereco')->getValue());
        $this->Model->setSexo($this->View->getForm()->getField('sexo')->getValue());
        $this->Model->setCidade($this->View->getForm()->getField('cidade')->getValue());
        $this->Model->setNascimento($this->View->getForm()->getField('nascimento')->getValue());
        $this->Model->setSaldoDevedor(0);
        $this->Model->setAtivo(true);
        $this->Model->insert();
        //USUARIO
        $oUsuario = $this->ModelUsuario;
        $oUsuario->setCliente($this->Model);
        $oUsuario->setLogin($this->View->getForm()->getField('login')->getValue());
        $oUsuario->setEmail($this->View->getForm()->getField('email')->getValue());
        $oUsuario->setSenha($this->View->getForm()->getField('senha')->getValue());
        $oUsuario->setAtivo(true);
        $oUsuario->setTipo(ModelUsuario::TIPO_NORMAL);
        $oUsuario->setSenhaExpiracao($this->View->getForm()->getField('senhaExpiracao')->getValue());
        $oUsuario->setTentativaLogin(0);
        //$oUsuario->insert();
    }
    
    protected function getModel() {
        return new ModelCliente();
    }
    
    protected function setViewValuesFromRequest(){
        $aFields = $this->View->getForm()->getFields();
        foreach($aFields as $oField){
            $sValue = $this->App->getParam($oField->getName());
            $oField->setValue($sValue);
        }
    }

}
