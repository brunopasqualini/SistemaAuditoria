<?php
namespace App\Core;

class ComponentAttr {

    private $attr = [];

    public function add($sAttr, $xValue = ''){
        $this->attr[$sAttr] = $xValue;
        return $this;
    }

    public function get($sAttr){
        return isset($this->attr[$sAttr]) ? $this->attr[$sAttr] : null;
    }

    public function has($sAttr){
        return isset($this->attr[$sAttr]);
    }

    public function del($sAttr){
        unset($this->attr[$sAttr]);
    }

    public function __toString(){
        $sAttribute = '';
        foreach($this->attr as $sAttr => $xValue){
            $sAttribute .= ' ' . $sAttr;
            if(!isEmpty($xValue)){
                $sAttribute .= '="'.$xValue.'"';
            }
        }
        return trim($sAttribute);
    }

}
