<?php
namespace App\Core\Form;

use App\Core\ElementRenderer;
use App\Core\Element;
use App\Core\Form\FieldHidden;

class Form implements ElementRenderer {

    private $Form;
    private $Button;

    private $params = [];
    private $fields = [];
    private $readonly;
    private $descBtn;

    public function __construct($sPath, $sProcess){
        $this->setPath($sPath);
        $this->setProcess($sProcess);
        $this->Form = new Element('form');
        $this->Form->getAttr()->add('method', 'post');
    }

    private function verifyField(Field $oField){
        $this->fields[] = $oField;
    }

    public function addField(){
        $aParams = func_get_args();
        foreach ($aParams as $oField) {
            $this->verifyField($oField);
        }
        return $this;
    }

    public function addFieldHidden($sName, $sValue){
        $oFieldHidden = new FieldHidden($sName);
        $oFieldHidden->setValue($sValue);
        $this->addField($oFieldHidden);
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

    public function getCss(){
        return $this->Form->getCss();
    }

    public function getAttr(){
        return $this->Form->getAttr();
    }

    public function addParam($sParam, $sValue = ''){
        $this->params[$sParam] = $sValue;
    }

    public function setPath($sPath){
        $this->addParam('path', $sPath);
    }

    public function setProcess($sProcess){
        $this->addParam('process', $sProcess);
    }

    public function setAction($sAction){
        $this->addParam('action', $sAction);
    }

    public function setReadonly($bReadonly){
        $this->readonly = $bReadonly;
        foreach($this->fields as $oField){
            $oField->setReadonly($bReadonly);
        }
    }

    public function setDescriptionBtn($sDescription){
        $this->descBtn = $sDescription;
    }

    public function render(){
        $this->Form->getAttr()->add('action', $this->getQueryString());
        foreach($this->fields as $oField){
            if($oField instanceof FieldHidden){
                $this->Form->addChild($oField);
                continue;
            }
            $oContainer = new Element('div');
            $oContainer->getCss()->addClass('input-field');
            $oLabel = new Element('label', Element::TYPE_CONTENT);
            $oLabel->getAttr()->add('for', $oField->getName());
            $oLabel->setText($oField->getLabel());
            if(!isEmpty($oField->getIcon())){
                $oIcon = new Element('i', Element::TYPE_CONTENT);
                $oIcon->getCss()->addClass('material-icons prefix');
                $oIcon->setText($oField->getIcon());
                $oContainer->addChild($oIcon);
            }
            $oContainer->addChild($oField, $oLabel);
            $this->Form->addChild($oContainer);
        }
        if($this->readonly !== true){
            $this->Form->addChild($this->getButton());
        }
        $this->Form->render();
    }

    private function getButton(){
        if(!isset($this->Button)){
            $this->Button = new Element('button', Element::TYPE_CONTENT);
            $this->Button->setText($this->descBtn);
            $this->Button->getCss()->addClass('btn cor-tema waves-effect')->add('width', '100%');
            $this->Button->getAttr()->add('type', 'submit')->add('name', 'enviar');
        }
        return $this->Button;
    }

    public function setButton(Element $oButton){
        $this->Button = $oButton;
    }

    public function getQueryString(){
        return '?' . http_build_query($this->params);
    }
}
