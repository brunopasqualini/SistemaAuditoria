<?php
namespace App\View;

use App\Core\Element;
use App\Core\Form\Form;

abstract class ViewForm extends ViewDefault {

    //http://demo.geekslabs.com/materialize/v3.1/form-validation.html

    private $Form;
    private $message;

    public function __construct(){
        $this->Form = $this->getForm();
        $this->initForm($this->Form);
    }

    abstract protected function initForm(Form $oForm);

    public function getForm(){
        if(!isset($this->Form)){
            $this->Form = $this->getFormInstance();
            $this->Form->setDescriptionBtn($this->getDescriptionFromAction());
        }
        return $this->Form;
    }

    private function getFormInstance(){
        return new Form($this->getFormPath(), $this->getFormProcess());
    }

    abstract protected function getFormPath();

    protected function getFormProcess(){
        return 'process';
    }

    protected function createContent(){
        $this->criaTitulo();
        $this->criaAreaMessage();
        $this->Form->render();
    }

    public function setTitle($sTitle){
        return parent::setTitle($this->getDescriptionFromAction() . ' ' . $sTitle);
    }

    public function setMessage($sMessage){
        $this->message = $sMessage;
    }

    private function criaAreaMessage(){
        if(!isEmpty($this->message)){
            $oContainer = new Element('div');
            $oContainer->getCss()->addClass('card-panel red lighten-2');
            $oContainer->getCss()->add('margin-bottom', '24px');
            $oSpan = new Element('span', Element::TYPE_CONTENT);
            $oSpan->getCss()->addClass('white-text text-darken-2');
            $oSpan->setText($this->message);
            $oContainer->addChild($oSpan);
            $oContainer->render();
        }
    }

    private function criaTitulo(){
        $oCtnTitle = new Element('div');
        $oCtnTitle->getCss()->addClass('center-align');
        $oTexto    = new Element('p', Element::TYPE_CONTENT);
        $oTexto->setText($this->getTitle());
        $oBold     = new Element('b');
        $oBold->addChild($oTexto);
        $oCtnTitle->addChild($oBold);
        $oCtnTitle->render();
    }

    protected function getDescriptionFromAction(){
        switch (\App::getInstance()->getParam('action')) {
            case \App\Controller\Controller::ACTION_INSERT:
                return 'Incluir';
            case \App\Controller\Controller::ACTION_UPDATE:
                return 'Alterar';
            case \App\Controller\Controller::ACTION_READ:
                return 'Visualizar';
        }
    }

}
