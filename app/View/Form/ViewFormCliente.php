<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldPassword;
use App\Core\Form\FieldNumeric;
use App\Core\Form\FieldCombo;
use App\Model\ModelCliente;

class ViewFormCliente extends ViewForm {

    public function __construct(){
        $this->setTitle('Cliente');
        parent::__construct('formCliente');
    }

    protected function initForm(Form $oForm){
        $oNome     = new Field('text', 'nome', 'Nome', false);
        $oNome->setLength(200);
        $oEndereco = new Field('text', 'endereco', 'Endereco', false);
        $oEndereco->setLength(500);
        $oSexo = new FieldCombo('sexo', 'Sexo', false);
        $oSexo->setCombo([
            ModelCliente::SEXO_MASCULINO => 'Masculino',
            ModelCliente::SEXO_FEMININO  => 'Feminino'
        ]);
        $oNascimento = new Field('date', 'nascimento', '', false);
        $oNascimento->getCSS()->addClass('datepicker');
//        $oSaldoDevedor = new FieldNumeric('saldoDevedor', 'Saldo Devedor', false);
//        $oSaldoDevedor->setLength(17);
        $oLogin = new Field('text', 'login', 'Login', false);
        $oLogin->setLength(100);
        $oEmail = new Field('text', 'email', 'Email', false);
        $oEmail->setLength(100);
        $oSenha = new FieldPassword('password', 'password', false);
        $oSenha->setLength(100);
        $oForm->addField($oNome, $oEndereco, $oSexo, $oNascimento, $oLogin, $oEmail, $oSenha);
    }

}
