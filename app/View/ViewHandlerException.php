<?php
namespace App\View;

use App\Core\Element;

class ViewHandlerException extends ViewDefault{

    private $descricaoErro = '';

    protected function createContent(){
        $this->criaTitulo();
    }

    private function criaTitulo(){
        $oCtnTitulo = new Element('div');
        $oCtnTitulo->getCss()->addClass('center-align');
        $oTitulo = new Element('h5', Element::TYPE_CONTENT);
        $oTitulo->setText('Ops! Parece que aconteceu um problema');
        $oCtnTitulo->addChild($oTitulo);
        $this->addDescricaoErro($oCtnTitulo);
        $oCtnTitulo->render();
    }

    private function addDescricaoErro(Element $oPai){
        if(!isEmpty($this->descricaoErro)){
            $oDescricao = new Element('p', Element::TYPE_CONTENT);
            $oDescricao->setText($this->descricaoErro);
            $oPai->addChild($oDescricao);
        }
    }

    public function setDescricaoErro($descricao){
        $this->descricaoErro = $descricao;
    }

}
