<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormProduto;


class ViewGridProduto extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Produto');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridProduto');
        $oGrid->addField(new GridField('codigo',    'Código'));
        $oGrid->addField(new GridField('descricao', 'Descrição'));
        $oGrid->addField(new GridField('preco',     'Preço'));
        $oGrid->addField(new GridField('estoque',   'Estoque'));

        $oForm = new ViewFormProduto();
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
