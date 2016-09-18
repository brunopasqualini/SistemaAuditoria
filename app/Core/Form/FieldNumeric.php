<?php
namespace App\Core\Form;

use App\Core\Element;
use App\Core\Exception\Form\InvalidValueFieldException;

class FieldNumeric extends Field {

    public function __construct($sName, $sLabel, $bRequired = false){
        parent::__construct('text', $sName, $sLabel, $bRequired, Element::TYPE_OPENED);
    }

    public function checkValueBeforeSet($sValue){
        parent::checkValueBeforeSet($sValue);
        if(!isEmpty($sValue) && !is_numeric($sValue)){
            throw new InvalidValueFieldException($this->getLabel(), $sValue);
        }
    }

    public function getValue(){
        $sValue = parent::getValue();
        if(isEmpty($sValue)){
            return '';
        }
        return (float) $sValue;
    }

}
