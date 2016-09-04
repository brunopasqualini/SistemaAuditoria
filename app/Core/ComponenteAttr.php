<?php
namespace App\Core;

class ComponenteAttr {

    private $attr = [];

    public function add($aAttr, $sValue = null){
        $this->attr[$aAttr] = $sValue;
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
        foreach($this->attr as $sAttr => $sValue){
            $sAttribute .= ' ' . $sAttr;
            if(!is_null($sValue)){
                $sAttribute .= '="'.$sValue.'"';
            }
        }
        return trim($sAttribute);
    }

}
