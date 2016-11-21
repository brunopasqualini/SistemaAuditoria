<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldPassword;
use App\View\Form\ViewFormCliente;

class ViewFormCadastroCliente extends ViewForm {

    public function __construct(){
        $this->setTitle('Cadastro Cliente');
        parent::__construct('formCadastroCliente');
    }
    
    public function getForm() {
        $oForm = parent::getForm();
        $oForm->setDescriptionBtn('Cadastrar');
        return $oForm;
    }

    protected function initForm(Form $oForm){
        $oNome = new Field('text', 'nome', 'Nome', true);
        $oNome->setLength(200);
        $oSexo = ViewFormCliente::getComboSexo();
        $oNascimento = new Field('text', 'nascimento', 'Nascimento', true);
        //$oNascimento->getCSS()->addClass('datepicker');
        $oEndereco = new Field('text', 'endereco', 'Endereço', true);
        $oEndereco->setLength(500);
        $oCidade = ViewFormCidade::getComboCidade();
        $oLogin = new Field('text', 'login', 'Login', true);
        $oLogin->setLength(50);
        $oSenha = new FieldPassword('senha', 'Senha', true);
        $oSenha->setLength(100);
        $oEmail = new Field('text', 'email', 'Email', true);
        $oEmail->setLength(100);
        $oForm->addField($oNome, $oEndereco, $oSexo, $oNascimento, $oCidade, $oLogin, $oSenha, $oEmail);
    }

}
