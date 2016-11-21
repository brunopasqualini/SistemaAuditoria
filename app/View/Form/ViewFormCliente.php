<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldCombo;
use App\Model\ModelCliente;

class ViewFormCliente extends ViewForm {

    public function __construct(){
        $this->setTitle('Cliente');
        parent::__construct('formCliente');
    }

    protected function initForm(Form $oForm){
        $oNome = new Field('text', 'nome', 'Nome', true);
        $oNome->setLength(200);
        $oSexo = self::getComboSexo();
        $oNascimento = new Field('text', 'nascimento', 'Nascimento', true);
        //$oNascimento->getCSS()->addClass('datepicker');
        $oEndereco = new Field('text', 'endereco', 'Endereço', true);
        $oEndereco->setLength(500);
        $oForm->addField($oNome, $oEndereco, $oSexo, $oNascimento);
    }
    
    
    public static function getComboSexo($sNome = 'sexo', $sLabel = 'Sexo', $oObrigatorio = true) {
        $oSexo = new FieldCombo($sNome, $sLabel, $oObrigatorio);
        $oSexo->setCombo([
            ModelCliente::SEXO_MASCULINO => 'Masculino',
            ModelCliente::SEXO_FEMININO  => 'Feminino'
        ]);
        return $oSexo;
    }

}
