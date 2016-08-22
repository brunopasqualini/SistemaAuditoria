<?php
class ViewLogin extends ViewDefault {

    protected function criaConteudo(Elemento $oContainer){
        $oForm = new Formulario('teste');
        $oUser = new Campo('text', 'username', 'Usuário');
        $oUser->setIcon('perm_identity');
        $oPass = new Campo('password', 'password', 'Senha');
        $oPass->setIcon('lock');
        $oForm->addField($oUser, $oPass);
        $oForm->setDescriptionBtn('Entrar');
        $oContainer->addFilhos($this->criaTitulo(), $oForm);
    }

    private function criaTitulo(){
        $oCtnTitle = new Elemento('div');
        $oCtnTitle->getCss()->addClass('center-align');
        $oTexto = new Elemento('p', Elemento::TYPE_CONTENT);
        $oTexto->setTexto('Efetuar Login');
        $oBold = new Elemento('b');
        $oBold->addFilhos($oTexto);
        $oCtnTitle->addFilhos($oBold);
        return $oCtnTitle;
    }

}
