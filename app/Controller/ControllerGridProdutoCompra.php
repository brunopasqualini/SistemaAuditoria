<?php
namespace App\Controller;

use App\Model\ModelAbstract;

class ControllerGridProdutoCompra extends ControllerGrid {
    
    protected function checkPrivileges(\App\Model\ModelUsuario $oUser) {
        return true;
    }
    
    public function getRecords(){
        echo json_encode(ModelAbstract::getAllWithCondition($this->Model, ['estoque' => '> ?'], [0], 1));
    }
    
    protected function getModel() {
        return new \App\Model\ModelProduto();
    }
    
}