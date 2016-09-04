<?php
namespace App\View;

use App\Core\Element;
use App\Core\Form\Form;
use App\Core\Form\Field;

class ViewLogin extends ViewDefault {

    protected function createContent(Element $oContainer){
        $oForm = new Form('teste');
        $oUser = new Field('text', 'username', 'Usuário');
        $oUser->setIcon('perm_identity');
        $oPass = new Field('password', 'password', 'Senha');
        $oPass->setIcon('lock');
        $oForm->addField($oUser, $oPass);
        $oForm->setDescriptionBtn('Entrar');
        $oContainer->addChild($this->criaTitulo(), $oForm);
    }

    private function criaTitulo(){
        $oCtnTitle = new Element('div');
        $oCtnTitle->getCss()->addClass('center-align');
        $oTexto = new Element('p', Element::TYPE_CONTENT);
        $oTexto->setText('Efetuar Login');
        $oBold = new Element('b');
        $oBold->addChild($oTexto);
        $oCtnTitle->addChild($oBold);
        return $oCtnTitle;
    }

}
