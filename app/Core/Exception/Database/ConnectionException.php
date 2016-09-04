<?php
namespace App\Core\Exception\Database;

class ConnectionException extends \Exception {

    public function __construct(){
        parent::__construct('Não foi possível se comunicar com o banco de dados', 0, null);
    }

}
