<?php
namespace App\Core\Form;

use App\Core\Element;

class FieldPassword extends Field {

    private $value;

    public function __construct($sName, $sLabel, $bRequired = false){
        parent::__construct('password', $sName, $sLabel, $bRequired, Element::TYPE_OPENED);
    }

    public function setValue($sValue){
        $this->checkValueBeforeSet($sValue);
        $this->value = isEmpty($sValue) ? '' : md5($sValue);
        return $this;
    }

    public function getValue(){
        return $this->value;
    }

}
