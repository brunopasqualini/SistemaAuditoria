<?php
class ComponenteCSS {

    private $class = [];
    private $prop  = [];

    public function addProp($prop, $value){
        $this->prop[$prop] = $value;
        return $this;
    }

    public function addClass($name){
        $this->class[] = $name;
        return $this;
    }

    public function __toString() {
        $sClass = implode(' ', $this->class);
        $sClass = isEmpty($sClass) ? '' : 'class="'.$sClass.'"';
        $sProp  = '';
        foreach($this->prop as $prop => $value){
            $sProp .= "{$prop}:{$value};";
        }
        $sProp = isEmpty($sProp) ? '' : 'style="'.$sProp.'"';
        return trim($sClass . ' ' . $sProp);
    }

}
