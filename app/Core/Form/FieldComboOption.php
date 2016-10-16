<?php
namespace App\Core\Form;

use App\Core\Element;

class FieldComboOption extends Element {

    public function __construct($sValue, $sLabel){
        parent::__construct('option', Element::TYPE_CONTENT);
        $this->setValue($sValue);
        $this->setLabel($sLabel);
    }

    public function setValue($sValue){
        $this->getAttr()->add('value', $sValue);
    }

    public function getValue(){
        return $this->getAttr()->get('value');
    }

    public function setLabel($sLabel){
        $this->setText($sLabel);
    }

    public function setSelected($bSelected){
        if($bSelected){
            $this->getAttr()->add('selected');
        }else{
            $this->getAttr()->del('selected');
        }
    }

    public function isSelected(){
        return $this->getAttr()->has('selected');
    }

}
