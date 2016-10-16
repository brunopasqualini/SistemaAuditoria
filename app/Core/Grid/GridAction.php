<?php
namespace App\Core\Grid;

use App\Core\Element;
use App\Core\Form\Form;

class GridAction {

    private $Button;
    private $src;
    private $inline;
    private $description;
    private $icon;
    private $events = [];

    public function __construct($sDescription, $sIcon, $bInline, Form $oForm, $sAction){
        $this->description = $sDescription;
        $this->icon        = $sIcon;
        $this->inline      = $bInline;
        $this->Button      = new Element('button', Element::TYPE_CONTENT);
        $oForm->setAction($sAction);
        $this->src = $oForm->getQueryString();
    }

    public function getButton(){
        $oBtn = $this->Button;
        $oBtn->setText($this->description);
        $oBtn->getCss()
             ->addClass('btn cor-tema waves-effect');
        $oBtn->getAttr()
             ->add('type', 'button')
             ->add('title', $this->description)
             ->add('data-src', $this->src);
        $this->prepareClick();
        if(!isEmpty($this->icon)){
            $oIcon = new Element('i', Element::TYPE_CONTENT);
            $oIcon->getCss()->addClass('material-icons');
            $oIcon->setText($this->icon);
            $oBtn->addChild($oIcon);
            ob_start();
            $oIcon->render();
            $oBtn->setText(ob_get_clean());
        }
        return $oBtn;
    }

    public function isInline(){
        return $this->inline;
    }

    public function addParamsEvent($aDefaultParams){
        if(count($this->events) == 0){
            return;
        }
        foreach($this->events as $sEventName => $aEvents){
            foreach($aEvents as $sFunctionName => $aParams){
                $this->events[$sEventName][$sFunctionName] = array_merge($aParams, $aDefaultParams);
            }
        }
    }

    public function on($sEventName, $sFunctionName, $aParams = []){
        if(!isset($this->events[$sEventName])){
            $this->events[$sEventName] = [];
        }
        if(!isset($this->events[$sEventName][$sFunctionName])){
            $this->events[$sEventName][$sFunctionName] = [];
            $this->addParamsEvent(['$event']);
        }
        $aParams = array_merge($this->events[$sEventName][$sFunctionName], $aParams);
        $this->events[$sEventName][$sFunctionName] = $aParams;
    }

    private function prepareClick(){
        if(!isset($this->events['click'])){
            return;
        }
        $aFunctions = [];
        foreach($this->events['click'] as $sFunctionName => $aParams){
            $sParams      = implode(',', $aParams);
            $aFunctions[] = "{$sFunctionName}({$sParams})";
        }
        $this->Button->getAttr()->add('ng-click', implode('; ', $aFunctions));
    }

}
