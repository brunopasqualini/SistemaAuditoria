<?php
namespace App\Core\Form;

use App\Core\Element;
use App\Core\Exception\Form\InvalidValueFieldException;

class FieldPassword extends Field {
    
    const CRIPT_KEY = '&Na&33-;\z';

    private $value;

    public function __construct($sName, $sLabel, $bRequired = false){
        parent::__construct('password', $sName, $sLabel, $bRequired, Element::TYPE_OPENED);
    }
    
    public function checkValueBeforeSet($sValue) {
        parent::checkValueBeforeSet($sValue);
        if(strlen($sValue) < 5){
            throw new InvalidValueFieldException($this->getName(), '');
        }
        else if($sValue == '12345'){
            throw new InvalidValueFieldException($this->getName(), '');
        }
        else if($sValue == 'abcde'){
            throw new InvalidValueFieldException($this->getName(), '');
        }
    }

    public function setValue($sValue){
        $this->checkValueBeforeSet($sValue);
        $this->value = isEmpty($sValue) ? '' : md5($sValue . self::CRIPT_KEY);
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

}
