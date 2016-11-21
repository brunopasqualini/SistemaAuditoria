<?php
namespace App\Controller;

use App\Model\ModelAbstract;

class ControllerGridVenda extends ControllerGrid {
    
    protected function checkPrivileges(\App\Model\ModelUsuario $oUser) {
        return true;
    }
    
    public function getRecords(){
        echo json_encode(ModelAbstract::getAllWithCondition($this->Model, [
            'Cliente.codigo' => ' = ?'
        ], [self::getUser()->getCliente()->getCodigo()], 1));
    }
    
}