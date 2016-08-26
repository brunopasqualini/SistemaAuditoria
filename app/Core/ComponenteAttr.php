<?php
class ComponenteAttr {

    private $attr = [];

    public function addAttr($attr, $value = null){
        $this->attr[$attr] = $value;
        return $this;
    }

    public function getAttr($attr){
        return isset($this->attr) ? $this->attr[$attr] : null;
    }

    public function delAttr($attr){
        unset($this->attr[$attr]);
    }

    public function __toString(){
        $sAttr = '';
        foreach($this->attr as $attr => $value){
            $sAttr .= ' ' . $attr;
            if(!is_null($value)){
                $sAttr .= '="'.$value.'"';
            }
        }
        return trim($sAttr);
    }

}
