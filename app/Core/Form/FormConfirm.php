<?php
namespace App\Core\Form;

use App\Core\ElementRenderer;
use App\Core\Element;
use App\Core\ElementModal;
use App\Core\Form\Form;

class FormConfirm implements ElementRenderer {

    private $params = [];
    private $path;
    private $action;

    public function __construct($sPath, $sAction){
        $this->path   = $sPath;
        $this->action = $sAction;
    }

    public function render(){
        $oForm = new Form($this->path, 'process');
        $oForm->setAction($this->action);
        $oForm->getAttr()->add('ng-submit', 'onSubmitForm($event)');
        $oForm->getCss()->add('display', 'inline-block');
        foreach($this->params as $sName => $sValue){
            $oForm->addFieldHidden($sName, $sValue);
        }
        $oForm->setButton($this->getNewBtn('Sim'));
        $oTitulo = new Element('h5', Element::TYPE_CONTENT);
        $oTitulo->setText('Confirmação');
        $oMensagem = new Element('p', Element::TYPE_CONTENT);
        $oMensagem->setText('Desejar realmente excluir o registro ?');
        ob_start();
        $oTitulo->render();
        $oMensagem->render();
        $oForm->render();
        $oBtnNao = $this->getNewBtn('Não');
        $oBtnNao->getAttr()->add('onclick', '$(this).closest(\'.modal\').closeModal()');
        $oBtnNao->render();
        ElementModal::renderContent(ob_get_clean());
    }

    private function getNewBtn($sDescription){
        $oButton = new Element('button', Element::TYPE_CONTENT);
        $oButton->setText($sDescription);
        $oButton->getCss()->addClass('modal-action waves-effect waves-cor-tema btn-flat');
        $oButton->getAttr()->add('type', 'submit')->add('name', 'enviar');
        return $oButton;
    }

    public function addParam($sParam, $sValue = ''){
        $this->params[$sParam] = $sValue;
    }

}
