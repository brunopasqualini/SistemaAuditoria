<?php
namespace App\View\Form;

use App\Core\Form\Form;
use App\Core\Form\Field;
use App\Core\Form\FieldNumeric;
use App\Core\Form\FieldCombo;
use App\Model\ModelCidade;
use App\Model\ModelAbstract;

class ViewFormCidade extends ViewForm {

    public function __construct(){
        $this->setTitle('Cidade');
        parent::__construct('formCidade');
    }

    protected function initForm(Form $oForm){
        $oCep  = new FieldNumeric('cep',   'CEP',   true);
        $oCep->setLength(9);
        $oNome = new Field('text', 'nome', 'Nome', true);
        $oNome->setLength(150);
        $oEstado = new FieldCombo('estado', 'Estado', true);
        $oEstado->setCombo(\App\Model\ModelCidade::getEstados());
        $oForm->addField($oCep, $oNome, $oEstado);
    }
    
    public static function getOptionsComboCidade() {
        $aOpcoes = [];
        $aPessoas = ModelAbstract::getAll(new ModelCidade());
        for ($x = 0; $x < count($aPessoas); $x++) {
            $aOpcoes[$aPessoas[$x]->getCep()] = $aPessoas[$x]->getNome();
        }
        return $aOpcoes;
    }

}
