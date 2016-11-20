<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;
use App\Controller\ControllerForm;
use App\View\Form\ViewFormProdutoCompra;

class ViewGridProdutoCompra extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Produto Compra');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridProdutoCompra');
        $oGrid->addField(new GridField('codigo',    'Código'));
        $oGrid->addField(new GridField('descricao', 'Descrição'));
        $oGrid->addField(new GridField('preco',     'Preço'));
        $oGrid->addField(new GridField('estoque',   'Estoque'));

        $oForm = new ViewFormProdutoCompra();
        $oInc  = $oGrid->addAction('Comprar',    'shopping_cart',  $oForm->getForm(), ControllerForm::ACTION_UPDATE);
        $oInc->on('click', 'showModalForm');
    }

}
