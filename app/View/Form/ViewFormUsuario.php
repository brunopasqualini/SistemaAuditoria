<?php

namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldCombo;
use App\Model\ModelUsuario;
use App\Model\ModelCliente;
use App\Model\ModelAbstract;

class ViewFormUsuario extends ViewForm {

    public function __construct() {
        $this->setTitle('Usuario');
        parent::__construct('formUsuario');
    }

    protected function initForm(Form $oForm) {
        $oLogin = new Field('text', 'login', 'Login', true);
        $oLogin->setLength(50);
        $oSenha = new Field('password', 'senha', 'Senha', false);
        $oSenha->setLength(32);
        $oEmail = new Field('text', 'email', 'Email', true);
        $oEmail->setLength(100);
        $oSenhaExpira = new Field('date', 'senhaExpira', '', true);
        $oSenhaExpira->getCSS()->addClass('datepicker');
        $oTipo = new FieldCombo('tipo', 'Tipo', true);
        $oTipo->setCombo([
            ModelUsuario::TIPO_NORMAL => 'Normal',
            ModelUsuario::TIPO_ADMIN  => 'Administrador'
        ]);
        $oAtivo = new FieldCombo('ativo', 'Ativo', true);
        $oAtivo->setCombo([
            1 => 'Sim',
            0 => 'Não'
        ]);
        $oUsuario = new FieldCombo('cliente', 'Cliente', true);
        $oUsuario->setCombo($this->getOptionsComboPessoa());

        $oForm->addField($oLogin, $oSenha, $oEmail, $oTipo, $oAtivo, $oSenhaExpira, $oUsuario);
    }

    function getOptionsComboPessoa() {
        $aOpcoes = [];
        $aPessoas = ModelAbstract::getAll(new ModelCliente);
        for ($x = 0; $x < count($aPessoas); $x++) {
            $aOpcoes[$aPessoas[$x]->getCodigo()] = $aPessoas[$x]->getNome();
        }
        return $aOpcoes;
    }

}
