<?php
namespace App\View;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldPassword;

class ViewLogin extends ViewForm {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Efetuar Login');
    }

    protected function getFormPath(){
        return 'login';
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
