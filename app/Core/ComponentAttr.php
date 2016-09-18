<?php
namespace App\Core;

class ComponentAttr {

    private $attr = [];

    public function add($aAttr, $xValue = null){
        $this->attr[$aAttr] = $xValue;
        return $this;
    }

    public function get($sAttr){
        return isset($this->attr) ? $this->attr[$sAttr] : null;
    }

    public function del($sAttr){
        unset($this->attr[$sAttr]);
    }

    public function __toString(){
        $sAttribute = '';
        foreach($this->attr as $sAttr => $xValue){
            $sAttribute .= ' ' . $sAttr;
            if(!is_null($xValue)){
                $sAttribute .= '="'.$xValue.'"';
            }
        }
        return trim($sAttribute);
    }

}
