<?php
namespace App\Core\Exception\Form;

class EmptyValueFieldException extends \Exception {

    public function __construct($sName){
        parent::__construct("O valor do campo {$sName} é obrigatório", 0, null);
    }

}
