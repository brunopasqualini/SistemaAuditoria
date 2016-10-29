<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldNumeric;
use App\Core\Form\FieldCombo;
use App\Model\ModelCliente;

class ViewFormCliente extends ViewForm {

    public function __construct(){
        $this->setTitle('Cliente');
        parent::__construct('formCliente');
    }

    protected function initForm(Form $oForm){
        $oNome     = new Field('text', 'nome', 'Nome', true);
        $oNome->setLength(200);
        $oEndereco = new Field('text', 'endereco', 'Endereco', true);
        $oEndereco->setLength(500);
        $oSexo = new FieldCombo('sexo', 'Sexo', true);
        $oSexo->setCombo([
            [ModelCliente::SEXO_MASCULINO, 'Masculino'],
            [ModelCliente::SEXO_FEMININO, 'Feminino']
        ]);
        $oNascimento = new Field('date', 'nascimento', '', true);
        $oNascimento->getCSS()->addClass('datepicker');
        $oSaldoDevedor = new FieldNumeric('saldoDevedor', 'Saldo Devedor', true);
        $oSaldoDevedor->setLength(17);
        
        $oForm->addField($oNome, $oEndereco, $oSexo, $oNascimento, $oSaldoDevedor);
    }

}
