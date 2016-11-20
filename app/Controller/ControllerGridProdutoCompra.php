<?php
namespace App\Controller;

class ControllerGridProdutoCompra extends ControllerGrid {
    
    protected function checkPrivileges(\App\Model\ModelUsuario $oUser) {
        return true;
    }
    
    protected function getModel() {
        return new \App\Model\ModelProduto();
    }
    
}