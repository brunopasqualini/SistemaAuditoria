<?php
namespace App\View;

abstract class ViewPageAbstract {

    private $title;
    private $aCss = [];
    private $aJs  = [];

    public function __construct(){
        $this->init();
    }

    abstract protected function init();

    protected function addCss($sFile){
        $this->aCss[] = \App::getPath('css') . $sFile . '.css';
        return $this;
    }

    protected function addCssExternal($src){
        $this->aCss[] = $src;
        return $this;
    }

    protected function addJs($sFile){
        $this->aJs[] = \App::getPath('js') . $sFile . '.js';
        return $this;
    }

    public function setTitle($sTitle){
        $this->title = $sTitle;
        return $this;
    }

    public function render(){
        echo '<!DOCTYPE html>';
        echo '<html>';
        $this->doHead();
        $this->doBody();
        echo '</html>';
    }

    private function doHead(){
        echo '<head>';
        echo "<title>{$this->title}</title>";
        echo $this->getCss();
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '</head>';
    }

    private function getCss(){
        return implode('', array_map(function($sValue) {
            return '<link rel="stylesheet" type="text/css" href='.$sValue.'>';
        }, $this->aCss));
    }

    private function doBody(){
        echo '<body>';
        echo $this->createBody();
        echo $this->getJs();
        echo '</body>';
    }

    private function getJs(){
        return implode('', array_map(function($sSrc) {
            return '<script src='.$sSrc.'></script>';
        }, $this->aJs));
    }

    protected abstract function createBody();

}
