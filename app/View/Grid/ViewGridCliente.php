<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormCliente;

class ViewGridCliente extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Cliente');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridCliente');
        $oGrid->addField(new GridField('codigo',       'Código'));
        $oGrid->addField(new GridField('nome',         'Nome'));
        $oGrid->addField(new GridField('endereco',     'Endereço'));
        $oGrid->addField(new GridField('sexo',         'Sexo'));
        $oGrid->addField(new GridField('nascimento',   'Nascimento'));
        $oGrid->addField(new GridField('saldodevedor', 'Saldo Devedor'));
        $oGrid->addField(new GridField('cidade.nome',       'Cidade'));
        $oGrid->addField(new GridField('ativo',       'Ativo'));

        $oForm = new ViewFormCliente();
        $oInc  = $oGrid->addAction('Incluir',    '',           $oForm->getForm(), ControllerForm::ACTION_INSERT, false);
        $oExc  = $oGrid->addAction('Excluir',    'delete',     $oForm->getForm(), ControllerForm::ACTION_DELETE);
        $oAlt  = $oGrid->addAction('Alterar',    'mode_edit',  $oForm->getForm(), ControllerForm::ACTION_UPDATE);
        $oVis  = $oGrid->addAction('Visualizar', 'visibility', $oForm->getForm(), ControllerForm::ACTION_READ);
        $oInc->on('click', 'showModalInsert');
        $oExc->on('click', 'showModalForm');
        $oAlt->on('click', 'showModalForm');
        $oVis->on('click', 'showModalForm');
    }

}
