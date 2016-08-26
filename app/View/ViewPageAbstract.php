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

    protected function addCss($file){
        $this->aCss[] = \App::getPath('css') . $file . '.css';
        return $this;
    }

    protected function addCssExternal($src){
        $this->aCss[] = $src;
        return $this;
    }

    protected function addJs($file){
        $this->aJs[] = \App::getPath('js') . $file . '.js';
        return $this;
    }

    public function setTitulo($titulo){
        $this->title = $titulo;
        return $this;
    }

    public function render(){
        echo '<!DOCTYPE html>';
        echo '<html>';
        $this->criaHead();
        $this->criaBody();
        echo '</html>';
    }

    private function criaHead(){
        echo '<head>';
        echo "<title>{$this->title}</title>";
        echo $this->geraCss();
        echo '<meta charset="UTF-8">';
        echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
        echo '</head>';
    }

    private function geraCss(){
        return implode('', array_map(function($value) {
            return '<link rel="stylesheet" type="text/css" href='.$value.'>';
        }, $this->aCss));
    }

    private function criaBody(){
        echo '<body>';
        echo $this->criaCorpo();
        echo $this->geraJs();
        echo '</body>';
    }

    private function geraJs(){
        return implode('', array_map(function($value) {
            return '<script src='.$value.'></script>';
        }, $this->aJs));
    }

    protected abstract function criaCorpo();

}
