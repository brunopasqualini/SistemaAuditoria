<?php
namespace App\View\Grid;

use App\View\ViewDefault;
use App\Core\Element;
use App\Core\Grid\Grid;

abstract class ViewGrid extends ViewDefault {

    private $Grid;

    public function __construct(){
        $this->Grid = $this->getGrid();
        $this->initGrid($this->Grid);
    }

    protected function beforeRender(){
        parent::beforeRender();
        $this->addJs('angular.min');
        $this->addJsInternal('viewgrid');
    }

    public function getGrid(){
        if(!isset($this->Grid)){
            $this->Grid = new Grid();
        }
        return $this->Grid;
    }

    abstract protected function initGrid(Grid $oGrid);

    protected function createContent(){
        $this->createTitle();
        $this->Grid->render();
    }

    public function setTitle($sTitle){
        return parent::setTitle('Consultar ' . $sTitle);
    }

    private function createTitle(){
        $oCtnTitle = new Element('div');
        $oCtnTitle->getCss()->addClass('center-align');
        $oTexto    = new Element('p', Element::TYPE_CONTENT);
        $oTexto->setText($this->getTitle());
        $oBold     = new Element('b');
        $oBold->addChild($oTexto);
        $oCtnTitle->addChild($oBold);
        $oCtnTitle->render();
    }

}
