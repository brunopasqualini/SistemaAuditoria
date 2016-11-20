<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldPassword;
use App\Core\Form\FieldNumeric;
use App\Core\Form\FieldCombo;
use App\Model\ModelCliente;

class ViewFormCadastroCliente extends ViewForm {

    public function __construct(){
        $this->setTitle('Cadastro Cliente');
        parent::__construct('formCadastroCliente');
    }

    protected function initForm(Form $oForm){
        $oNome     = new Field('text', 'nome', 'Nome', false);
        $oNome->setLength(200);
        $oSexo = new FieldCombo('sexo', 'Sexo', false);
        $oSexo->setCombo([
            ModelCliente::SEXO_MASCULINO => 'Masculino',
            ModelCliente::SEXO_FEMININO  => 'Feminino'
        ]);
        $oNascimento = new Field('date', 'nascimento', 'Nascimento', false);
        $oNascimento->getCSS()->addClass('datepicker');
        $oEndereco = new Field('text', 'endereco', 'Endereco', false);
        $oEndereco->setLength(500);
        $oCidade = new FieldCombo('cidade', 'Cidade', true);
        $oCidade->setCombo(ViewFormCidade::getOptionsComboCidade());
        $oSaldoDevedor = new FieldNumeric('saldoDevedor', 'Saldo Devedor', false);
        $oSaldoDevedor->setLength(17);
        $oLogin = new Field('text', 'login', 'Login', false);
        $oLogin->setLength(100);
        $oEmail = new Field('text', 'email', 'Email', false);
        $oEmail->setLength(100);
        $oSenha = new FieldPassword('password', 'password', false);
        $oSenha->setLength(100);
        $oSenhaExpira = new Field('date', 'senhaexpiracao', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Senha Expira', false);
        $oSenhaExpira->getCSS()->addClass('datepicker');
//------------- COLOCAR OS CAMPOS login, senha, email DO CADASTRO DE USUARIO
        
        $oForm->addField($oNome, $oEndereco, $oSexo, $oNascimento, $oCidade, $oSaldoDevedor, $oLogin, $oEmail, $oSenha, $oSenhaExpira);
    }

}
