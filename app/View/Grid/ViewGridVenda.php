<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormVenda;

class ViewGridVenda extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Venda');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridVenda');
        $oGrid->addField(new GridField('data',          'Data da Venda'));
        $oGrid->addField(new GridField('quantidade',    'Quantidade'));
        $oGrid->addField(new GridField('datapagamento', 'Data de Pagamento'));
        $oGrid->addField(new GridField('valorpago',     'Valor do pagamento'));
        $oGrid->addField(new GridField('cliente',       'Cliente'));
        $oGrid->addField(new GridField('produto',       'Produto'));

        $oForm = new ViewFormVenda();
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
