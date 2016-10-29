<?php
namespace App\Core\Exception\Session;

class NotLoggedInException extends \Exception {
    
    public function __construct(){
        parent::__construct("Usuário não autenticado", 0, null);
    }
    
}