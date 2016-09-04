<?php
namespace App\Core\Form;

use App\Core\ElementRenderer;
use App\Core\Element;

class Form implements ElementRenderer {

    private $Form;

    private $fields = [];
    private $path;
    private $process;
    private $descBtn;

    public function __construct($sPath, $sProcess = 'processa'){
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

    public function setPath($sPath){
        $this->path = $sPath;
    }

    public function setProcess($sProcess){
        $this->process = $sProcess;
    }

    public function setDescriptionBtn($sDescription){
        $this->descBtn = $sDescription;
    }

    public function render(){
        $sUrl = "?path={$this->path}&process={$this->process}";
        $this->Form->getAttr()->add('action', $sUrl);
        foreach($this->fields as $oField){
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
        $oSubmit = new Element('button', Element::TYPE_CONTENT);
        $oSubmit->setText($this->descBtn);
        $oSubmit->getCss()
                ->addClass('btn cor-tema waves-effect')
                ->add('width', '100%');
        $oSubmit->getAttr()
                ->add('type', 'submit')
                ->add('name', 'enviar');

        $this->Form->addChild($oSubmit);
        $this->Form->render();
    }

}
