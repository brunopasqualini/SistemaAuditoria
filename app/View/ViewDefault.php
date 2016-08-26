<?php
namespace App\View;

use App\Core\Elemento;
use App\Core\ElementoImg;
use App\Core\ElementoLink;

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

    protected function criaCorpo() {
        $this->criaHeader();
        $oContainer = new Elemento('div');
        $oContainer->getCss()->addClass('container');
        $this->criaConteudo($oContainer);
        $oContainer->render();
        $this->criaFooter();
    }

    private function criaHeader(){
        $oHeader    = new Elemento('header');
        $oHeader->getCss()->addClass('cor-tema');
        $oContainer = new Elemento('div');
        $oContainer->getCss()->addClass('container');
        $oTitCtn    = new Elemento('div');
        $oTitCtn->getCss()->addClass('titulo nav-wrapper valing-wrapper center-align cor-tema');
        $oTitulo    = new Elemento('h3', Elemento::TYPE_CONTENT);
        $oTitulo->setTexto('Auditoria')->getCss()->addClass('white-text');
        $oSubTitulo = new Elemento('h5', Elemento::TYPE_CONTENT);
        $oSubTitulo->setTexto('"Auditorando as auditorias auditadas"')
                   ->getCss()->addClass('white-text');
        $oEnter     = new Elemento('br', Elemento::TYPE_OPENED);
        $oTitCtn->addFilhos($oTitulo, $oSubTitulo, $oEnter);
        $oContainer->addFilhos($oTitCtn);
        $oHeader->addFilhos($oContainer);
        $oHeader->render();
    }

    abstract protected function criaConteudo(Elemento $oContainer);

    private function criaFooter(){
        $oFooter = new Elemento('footer');
        $oFooter->getCss()->addClass('page-footer cor-tema');
        $oContainer = new Elemento('div');
        $oContainer->getCss()->addClass('container');
        $oFooter->addFilhos($oContainer);

        $oRow = new Elemento('div');
        $oRow->getCss()->addClass('row');
        $oContainer->addFilhos($oRow);

        $oCol1 = new Elemento('div');
        $oCol1->getCss()->addClass('col l6 s12');
        $oCol2 = new Elemento('div');
        $oCol2->getCss()->addClass('col l4 offset-l2 s12');
        $oRow->addFilhos($oCol1, $oCol2);

        $oNome = new Elemento('h5', Elemento::TYPE_CONTENT);
        $oNome->setTexto('Auditoria SC LTDA')->getCss()->addClass('white-text');
        $oEndereco = new Elemento('p', Elemento::TYPE_CONTENT);
        $oEndereco->setTexto('Endereço do seu Pedro')->getCss()->addClass('grey-text text-lighten-4');
        $oFone = new Elemento('p', Elemento::TYPE_CONTENT);
        $oFone->setTexto('Fone: (XX) 0000-0000')->getCss()->addClass('grey-text text-lighten-4');
        $oCol1->addFilhos($oNome, $oEndereco, $oFone);

        $oMensagem = new Elemento('h5', Elemento::TYPE_CONTENT);
        $oMensagem->setTexto('Fique conectado')->getCss()->addClass('white-text');
        $oLinkFB = new ElementoLink();
        $oLinkFB->getCss()->addClass('social grey-text text-lighten-3');
        $oLinkFB->addFilhos(new ElementoImg('fb.png'));
        $oLinkInsta = new ElementoLink();
        $oLinkInsta->getCss()->addClass('social grey-text text-lighten-3');
        $oLinkInsta->addFilhos(new ElementoImg('inst.png'));
        $oCol2->addFilhos($oMensagem, $oLinkFB, $oLinkInsta);

        $oCopyright = new Elemento('div');
        $oCopyright->getCss()->addClass('footer-copyright');

        $oContainer = new Elemento('div');
        $oContainer->getCss()->addClass('container');
        $oCopyright->addFilhos($oContainer);

        $oSpan = new Elemento('span', Elemento::TYPE_CONTENT);
        $oSpan->setTexto('© 2016 Copyright Text | Bruno Pasqualini & Kelvin Eger');
        $oContainer->addFilhos($oSpan);

        $oFooter->addFilhos($oCopyright);
        $oFooter->render();
    }

}
