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
        $this->setModelValuesFromView();
        $this->Model->setSaldoDevedor(0);
        $this->Model->setAtivo(true);
        $this->Model->insert();
        $oUsuario = $this->ModelUsuario;
        $oUsuario->setCliente($this->Model);
        $oUsuario->setLogin($this->View->getForm()->getField('login')->getValue());
        $oUsuario->setEmail($this->View->getForm()->getField('email')->getValue());
        $oUsuario->setSenha($this->View->getForm()->getField('senha')->getValue());
        $oUsuario->setAtivo(true);
        $oUsuario->setTipo(ModelUsuario::TIPO_NORMAL);
        $oUsuario->setSenhaExpiracao(ModelUsuario::getDataExpiracaoPadrao());
        $oUsuario->setTentativaLogin(0);
        $oUsuario->insert();
        $this->App->redirect('');
    }
    
    protected function getModel() {
        return new ModelCliente();
    }

}
