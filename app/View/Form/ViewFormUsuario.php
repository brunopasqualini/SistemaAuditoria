<?php

namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldCombo;
use App\Model\ModelUsuario;
use App\Core\Form\FieldNumeric;

class ViewFormUsuario extends ViewForm {

    public function __construct() {
        $this->setTitle('Usuario');
        parent::__construct('formUsuario');
    }

    protected function initForm(Form $oForm) {
        $oEmail = new Field('text', 'email', 'Email', true);
        $oEmail->setLength(100);
        $oTentativas  = new FieldNumeric('tentativaLogin', 'Tentativas', true);
        $oSenhaExpira = new Field('text', 'senhaExpira', 'Expiração Sehha', false);
        $oTipo  = self::getComboTipo();
        $oAtivo = self::getComboAtivo();
        $oForm->addField($oEmail, $oTipo, $oAtivo, $oTentativas, $oSenhaExpira);
    }
    
    public static function getComboTipo($sNome = 'tipo', $sLabel = 'Tipo', $oObrigatorio = true){
        $oTipo = new FieldCombo($sNome, $sLabel, $oObrigatorio);
        $oTipo->setCombo([
            ModelUsuario::TIPO_NORMAL => 'Normal',
            ModelUsuario::TIPO_ADMIN  => 'Administrador'
        ]);
        return $oTipo;
    }
    
    public static function getComboAtivo($sNome = 'ativo', $sLabel = 'Ativo', $oObrigatorio = true){
        $oAtivo = new FieldCombo($sNome, $sLabel, $oObrigatorio);
        $oAtivo->setCombo([
            1 => 'Sim',
            0 => 'Não'
        ]);
        return $oAtivo;
    }

}
