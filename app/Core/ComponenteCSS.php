<?php
namespace App\Core;

class ComponenteCSS {

    private $class = [];
    private $prop  = [];

    public function add($sProp, $sValue){
        $this->prop[$sProp] = $sValue;
        return $this;
    }

    public function addClass($sName){
        $this->class[] = $sName;
        return $this;
    }

    public function __toString() {
        $sClass = implode(' ', $this->class);
        $sClass = isEmpty($sClass) ? '' : 'class="'.$sClass.'"';
        $sProperties = '';
        foreach($this->prop as $sProp => $sValue){
            $sProperties .= "{$sProp}:{$sValue};";
        }
        $sProperties = isEmpty($sProperties) ? '' : 'style="'.$sProperties.'"';
        return trim($sClass . ' ' . $sProperties);
    }

}
