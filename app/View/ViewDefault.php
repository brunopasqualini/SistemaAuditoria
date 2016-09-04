<?php
namespace App\View;

use App\Core\Element;
use App\Core\ElementImg;
use App\Core\ElementLink;

abstract class ViewDefault extends ViewPageAbstract{

    protected function init() {
        $this->addCssExternal('https://fonts.googleapis.com/icon?family=Material+Icons')
             ->addCssExternal('https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css')
             ->addCss('css')
             ->addJs('jquery')
             ->addJs('materialize.min')
             ->addJs('jquery.validate.min')
             ->addJs('js');
    }

    protected function createBody() {
        $this->doHeader();
        $oContainer = new Element('div');
        $oContainer->getCss()->addClass('container');
        $this->createContent($oContainer);
        $oContainer->render();
        $this->doFooter();
    }

    private function doHeader(){
        $oHeader    = new Element('header');
        $oHeader->getCss()->addClass('cor-tema');
        $oContainer = new Element('div');
        $oContainer->getCss()->addClass('container');
        $oTitCtn    = new Element('div');
        $oTitCtn->getCss()->addClass('titulo nav-wrapper valing-wrapper center-align cor-tema');
        $oTitulo    = new Element('h3', Element::TYPE_CONTENT);
        $oTitulo->setText('Auditoria')->getCss()->addClass('white-text');
        $oSubTitulo = new Element('h5', Element::TYPE_CONTENT);
        $oSubTitulo->setText('"Auditorando as auditorias auditadas"')
                   ->getCss()->addClass('white-text');
        $oEnter     = new Element('br', Element::TYPE_OPENED);
        $oTitCtn->addChild($oTitulo, $oSubTitulo, $oEnter);
        $oContainer->addChild($oTitCtn);
        $oHeader->addChild($oContainer);
        $oHeader->render();
    }

    abstract protected function createContent(Element $oContainer);

    private function doFooter(){
        $oFooter = new Element('footer');
        $oFooter->getCss()->addClass('page-footer cor-tema');
        $oContainer = new Element('div');
        $oContainer->getCss()->addClass('container');
        $oFooter->addChild($oContainer);

        $oRow = new Element('div');
        $oRow->getCss()->addClass('row');
        $oContainer->addChild($oRow);

        $oCol1 = new Element('div');
        $oCol1->getCss()->addClass('col l6 s12');
        $oCol2 = new Element('div');
        $oCol2->getCss()->addClass('col l4 offset-l2 s12');
        $oRow->addChild($oCol1, $oCol2);

        $oNome = new Element('h5', Element::TYPE_CONTENT);
        $oNome->setText('Auditoria SC LTDA')->getCss()->addClass('white-text');
        $oEndereco = new Element('p', Element::TYPE_CONTENT);
        $oEndereco->setText('Endereço do seu Pedro')->getCss()->addClass('grey-text text-lighten-4');
        $oFone = new Element('p', Element::TYPE_CONTENT);
        $oFone->setText('Fone: (XX) 0000-0000')->getCss()->addClass('grey-text text-lighten-4');
        $oCol1->addChild($oNome, $oEndereco, $oFone);

        $oMensagem = new Element('h5', Element::TYPE_CONTENT);
        $oMensagem->setText('Fique conectado')->getCss()->addClass('white-text');
        $oLinkFB = new ElementLink();
        $oLinkFB->getCss()->addClass('social grey-text text-lighten-3');
        $oLinkFB->addChild(new ElementImg('fb.png'));
        $oLinkInsta = new ElementLink();
        $oLinkInsta->getCss()->addClass('social grey-text text-lighten-3');
        $oLinkInsta->addChild(new ElementImg('inst.png'));
        $oCol2->addChild($oMensagem, $oLinkFB, $oLinkInsta);

        $oCopyright = new Element('div');
        $oCopyright->getCss()->addClass('footer-copyright');

        $oContainer = new Element('div');
        $oContainer->getCss()->addClass('container');
        $oCopyright->addChild($oContainer);

        $oSpan = new Element('span', Element::TYPE_CONTENT);
        $oSpan->setText('© 2016 Copyright Text | Bruno Pasqualini & Kelvin Eger');
        $oContainer->addChild($oSpan);

        $oFooter->addChild($oCopyright);
        $oFooter->render();
    }

}
