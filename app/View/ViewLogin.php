<?php
namespace App\View;

use App\View\Form\ViewForm;
use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldPassword;

class ViewLogin extends ViewForm {

    public function __construct(){
        $this->setTitle('Efetuar Login');
        parent::__construct('login');
    }

    protected function initForm(Form $oForm){
        $oUser = new Field('text', 'login', 'Usuário', true);
        $oUser->setIcon('perm_identity');
        $oUser->setRequired(true);
        $oPass = new FieldPassword('senha', 'Senha', true);
        $oPass->setIcon('lock');
        $oPass->setRequired(true);
        $oForm->addField($oUser, $oPass);
        $oForm->setDescriptionBtn('Entrar');
    }

}
