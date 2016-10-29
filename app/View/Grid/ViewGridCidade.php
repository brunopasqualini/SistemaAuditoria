<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormCidade;

class ViewGridCidade extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Cidade');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridCidade');
        $oGrid->addField(new GridField('cep',    'CEP'));
        $oGrid->addField(new GridField('nome',   'Nome'));
        $oGrid->addField(new GridField('estado', 'Estado'));;

        $oForm = new ViewFormCidade();
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
