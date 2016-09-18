<?php
namespace App\View;

use App\Core\ElementRenderer;

abstract class ViewDefault implements ElementRenderer{

    private $title;
    private $aCss = [];
    private $aJs  = [];

    protected function beforeRender() {
        $this->addCssExternal('https://fonts.googleapis.com/icon?family=Material+Icons')
             ->addCss('materialize.min')
             ->addCss('css')
             ->addJs('jquery')
             ->addJs('materialize.min')
             ->addJs('jquery.validate.min')
             ->addJs('js');
    }

    public function render(){
        $this->beforeRender();
        echo $this->doHead();
        echo $this->doBody();
    }

    private function doHead(){
        return $this->loadTemplate('header', [
            'title' => $this->title,
            'style' => $this->getCss()
        ]);
    }

    private function getCss(){
        return implode('', array_map(function($sValue) {
            return '<link rel="stylesheet" type="text/css" href="'.$sValue.'">';
        }, $this->aCss));
    }

    private function doBody(){
        return $this->loadTemplate('body', [
            'content' => $this->createBody(),
            'script'  => $this->getJs()
        ]);
    }

    private function getJs(){
        return implode('', array_map(function($sSrc) {
            return '<script src="'.$sSrc.'"></script>';
        }, $this->aJs));
    }

    private function createBody() {
        ob_start();
        $this->createContent();
        return ob_get_clean();
    }

    abstract protected function createContent();

    protected function addCss($sFile){
        $this->aCss[] = getRelativePath('css') . $sFile . '.css';
        return $this;
    }

    protected function addCssExternal($src){
        $this->aCss[] = $src;
        return $this;
    }

    protected function addJs($sFile){
        $this->aJs[] = getRelativePath('js') . $sFile . '.js';
        return $this;
    }

    public function setTitle($sTitle){
        $this->title = $sTitle;
        return $this;
    }

    public function getTitle(){
        return $this->title;
    }

    protected function loadTemplate($sName, $aParams = []){
        return TemplateLoader::load($sName, $aParams);
    }

}
