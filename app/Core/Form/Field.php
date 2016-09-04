<?php
namespace App\Core\Form;

use App\Core\Element;

class Field extends Element {

    private $required;
    private $label;
    private $icon;

    public function __construct($sTag, $sName, $sLabel, $iType = Element::TYPE_OPENED){
        parent::__construct('input', $iType);
        $this->getAttr()->add('type', $sTag);
        $this->setName($sName);
        $this->setLabel($sLabel);
    }

    public function setName($sName){
        $this->getAttr()
             ->add('id', $sName)
             ->add('name', $sName);
    }

    public function getName(){
        return $this->getAttr()->get('name');
    }

    public function setLabel($sLabel){
        $this->label = $sLabel;
        return $this;
    }

    public function getLabel(){
        return $this->label;
    }

    public function setIcon($sName){
        $this->icon = $sName;
    }

    public function getIcon(){
        return $this->icon;
    }

    public function setValue($sValue){
        $this->getAttr()->add('value', $sValue);
        return $this;
    }

    public function getValue(){
        return $this->getAttr()->get('value');
    }

    public function setRequired($bRequired){
        $this->required = $bRequired;
        return $this;
    }

    public function getRequired(){
        return $this->required;
    }

    public function setLength($iLength){
        $this->getAttr()->add('maxlength', $iLength);
        return $this;
    }

    public function setWidth($iWidth){
        $this->getAttr()->add('size', $iWidth);
        return $this;
    }

    public function setReadonly($bReadonly){
        if($bReadonly){
            $this->getAttr()->add('readonly');
        }else{
            $this->getAttr()->del('readonly');
        }
    }

}
