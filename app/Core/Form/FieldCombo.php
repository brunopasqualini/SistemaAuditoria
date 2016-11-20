<?php
namespace App\Core\Form;

use App\Core\Element;
use App\Core\Exception\Form\InvalidValueFieldException;

class FieldCombo extends Field {

    public function __construct($sName, $sLabel, $bRequired = false){
        parent::__construct('', $sName, $sLabel, $bRequired, Element::TYPE_CLOSED, 'select');
    }

    public function setCombo(Array $aCombo){
        foreach($aCombo as $sValue => $sDescription){
            $this->newOption($sValue, $sDescription);
        }
    }

    public function setValue($sValue){
        $this->checkValueBeforeSet($sValue);
        if(isEmpty($sValue)){
            return;
        }
        $bHasValue = false;
        foreach($this->childs as $oChild){
            $oChild->setSelected($oChild->getValue() == $sValue);
            $bHasValue = !$bHasValue ? $oChild->getValue() == $sValue : $bHasValue;
        }
        if(!$bHasValue){
            throw new InvalidValueFieldException($this->getLabel(), $sValue);
        }
    }

    public function getValue(){
        foreach($this->childs as $oChild){
            if($oChild->isSelected()){
                return $oChild->getValue();
            }
        }
        return '';
    }

    public function newOption($sValue, $sLabel){
        $this->childs[] = new FieldComboOption($sValue, $sLabel);
    }

    public function addChild() {}
}