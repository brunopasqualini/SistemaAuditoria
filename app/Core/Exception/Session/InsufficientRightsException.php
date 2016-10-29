<?php
namespace App\Core\Exception\Session;

class InsufficientRightsException extends \Exception {
    
    public function __construct(){
        parent::__construct("Seu usuário não possui privilégio para acessar esta página", 0, null);
    }
    
}