<?php
namespace App\View;

use App\Core\ElementRenderer;

abstract class ViewDefault implements ElementRenderer{

    private $title;
    private $aCss = [];
    private $aJs  = [
        'src'      => [],
        'internal' => []
    ];

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
        $sScript  = implode('', array_map(function($sSrc) {
            return '<script src="'.$sSrc.'"></script>';
        }, $this->aJs['src']));
        $sScript .= '<script>' . implode('', $this->aJs['internal']) . '</script>';
        return $sScript;
    }

    private function createBody() {
        ob_start();
        $this->createContent();
        return ob_get_clean();
    }

    abstract protected function createContent();

    protected function addCss($sFile){
        return $this->addCssExternal(getRelativePath('css') . $sFile . '.css');
    }

    protected function addCssExternal($src){
        $this->aCss[] = $src;
        return $this;
    }

    protected function addJs($sFile){
        $this->aJs['src'][] = getRelativePath('js') . $sFile . '.js';
        return $this;
    }

    protected function addJsInternal($sFile){
        $sFile   = getPathFull('app' . DIRSEP . 'View' . DIRSEP . 'script') . $sFile . '.js';
        $sScript = file_get_contents($sFile);
        $this->aJs['internal'][] = $sScript;
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
