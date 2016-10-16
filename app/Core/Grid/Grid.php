<?php
namespace App\Core\Grid;

use App\Core\Element;
use App\Core\ElementModal;
use App\Core\Form\Form;

class Grid extends Element {

    private $Table;
    private $fields  = [];
    private $actions = [
        'inline' => [],
        'grid'   => []
    ];

    public function __construct(){
        parent::__construct('div');
        $this->Table = new Element('table');
        $this->Table->getAttr()->add('ng-hide', 'records.length == 0');
        $this->Table->getCss()->addClass('responsive-table striped bordered grid-view ng-hide');
    }

    private function verifyField(GridField $oField){
        $this->fields[] = $oField;
    }

    public function addField(){
        $aParams = func_get_args();
        foreach ($aParams as $oField) {
            $this->verifyField($oField);
        }
        return $this;
    }

    public function getFields(){
        return $this->fields;
    }

    public function getField($sName){
        foreach($this->fields as $oField){
            if($oField->getName() == $sName){
                return $oField;
            }
        }
    }

    public function setPath($sPath){
        $this->getAttr()
             ->add('path', $sPath)
             ->add('ng-app', 'gridApp')
             ->add('ng-controller', 'gridCtrl');
    }

    public function addAction($sDescription, $sIcon, Form $oForm, $sAction, $bInline = true){
        $oAction = new GridAction($sDescription, $sIcon, $bInline, $oForm, $sAction);
        $sType   = 'inline';
        if(!$oAction->isInline()){
            $sType = 'grid';
        }
        $this->actions[$sType][] = $oAction;
        return $oAction;
    }

    public function setInlineActionIdentifiers($sIdentifiers){
        foreach($this->actions['inline'] as $oAction){
            $oAction->addParamsEvent([$sIdentifiers]);
        }
    }

    public function render(){
        $this->createLayout();
        $this->createModals();
        parent::render();
    }

    private function createLayout(){
        $oRowHeader = new Element('tr');
        $oRowBody   = new Element('tr');
        $oRowBody->getAttr()->add('ng-repeat', 'record in records');
        foreach($this->fields as $oField){
            $oColumn = new Element('th', Element::TYPE_CONTENT);
            $oColumn->setText($oField->getTitle());
            $oRowHeader->addChild($oColumn);
            $oColumn = new Element('td', Element::TYPE_CONTENT);
            $oColumn->setText("{{record.{$oField->getName()}}}");
            $oRowBody->addChild($oColumn);
        }
        $oColumn = new Element('td');
        $oColumn->getCss()->addClass('grid-action');
        $oRowBody->addChild($oColumn);
        foreach($this->actions['inline'] as $oAction){
            $oColumn->addChild($oAction->getButton());
        }
        foreach($this->actions['grid'] as $oAction){
            $this->addChild($oAction->getButton());
        }
        $oHeader = new Element('thead');
        $oHeader->addChild($oRowHeader);
        $oBody   = new Element('tbody');
        $oBody->addChild($oRowBody);
        $this->Table->addChild($oHeader, $oBody);
        $this->addChild($this->Table);
    }

    private function createModals(){
        if(count($this->actions['inline']) == 0 && count($this->actions['grid']) == 0){
            return;
        }
        $this->addChild(new ElementModal('modalAjaxContent'));
    }

}
