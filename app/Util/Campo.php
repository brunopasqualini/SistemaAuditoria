<?php
class Campo extends Elemento {

    private $required;
    private $label;
    private $icon;

    public function __construct($tag, $name, $label, $type = Elemento::TYPE_OPENED){
        parent::__construct('input', $type);
        $this->getAttr()->addAttr('type', $tag);
        $this->setName($name);
        $this->setLabel($label);
    }

    public function setName($name){
        $this->getAttr()
             ->addAttr('id', $name)
             ->addAttr('name', $name);
    }

    public function getName(){
        return $this->getAttr()->getAttr('name');
    }

    public function setLabel($label){
        $this->label = $label;
        return $this;
    }

    public function getLabel(){
        return $this->label;
    }

    public function setIcon($name){
        $this->icon = $name;
    }

    public function getIcon(){
        return $this->icon;
    }

    public function setValue($value){
        $this->getAttr()->addAttr('value', $value);
        return $this;
    }

    public function getValue(){
        return $this->getAttr()->getAttr('value');
    }

    public function setRequired($required){
        $this->required = $required;
        return $this;
    }

    public function getRequired(){
        return $this->required;
    }

    public function setLength($length){
        $this->getAttr()->addAttr('maxlength', $length);
        return $this;
    }

    public function setWidth($width){
        $this->getAttr()->addAttr('size', $width);
        return $this;
    }

    public function setReadonly($readonly){
        if($readonly){
            $this->getAttr()->addAttr('readonly');
        }else{
            $this->getAttr()->delAttr('readonly');
        }
    }
    
}
