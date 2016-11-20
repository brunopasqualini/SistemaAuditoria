<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormUsuario;

class ViewGridUsuario extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Usuario');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridUsuario');
        $oGrid->addField(new GridField('codigo',  'Código'));
        $oGrid->addField(new GridField('cliente.nome', 'Cliente'));
        $oGrid->addField(new GridField('login',   'Login'));
        $oGrid->addField(new GridField('email',   'Email'));
        $oGrid->addField(new GridField('ativo',   'Situação'));
        $oGrid->addField(new GridField('cliente.cidade.cep',   'Cep'));
        $oGrid->addField(new GridField('tipo',    'Tipo'));
        $oGrid->addField(new GridField('cliente.saldodevedor', 'Saldo Devedor'));

        $oForm = new ViewFormUsuario();
        $oExc  = $oGrid->addAction('Excluir',    'delete',     $oForm->getForm(), ControllerForm::ACTION_DELETE);
        $oAlt  = $oGrid->addAction('Alterar',    'mode_edit',  $oForm->getForm(), ControllerForm::ACTION_UPDATE);
        $oVis  = $oGrid->addAction('Visualizar', 'visibility', $oForm->getForm(), ControllerForm::ACTION_READ);
        $oExc->on('click', 'showModalForm');
        $oAlt->on('click', 'showModalForm');
        $oVis->on('click', 'showModalForm');
    }

}
