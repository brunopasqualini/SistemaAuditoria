<?php
namespace App\Core\Exception\Form;

class InvalidValueFieldException extends \Exception {

    private $value;

    public function __construct($sName, $sValue){
        $this->value = $sValue;
        parent::__construct("O valor {$sValue} é inválido para o campo {$sName}", 0, null);
    }

    public function getValue(){
        return $this->value;
    }

}
