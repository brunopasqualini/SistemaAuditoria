<?php
namespace App\Core\Grid;

class GridField {

    private $name;
    private $title;
    private $width;

    public function __construct($sName, $sTitle, $sWidth = 'auto'){
        $this->setName($sName);
        $this->setTitle($sTitle);
        $this->setWidth($sWidth);
    }

    public function setName($sName){
        $this->name = $sName;
    }

    public function getName(){
        return $this->name;
    }

    public function setTitle($sTitle){
        $this->title = $sTitle;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setWidth($sWidth){
        $this->width = $sWidth;
    }

    public function getWidth(){
        return $this->widht;
    }

    public function formatValue($xValue){
        return $xValue;
    }

}
