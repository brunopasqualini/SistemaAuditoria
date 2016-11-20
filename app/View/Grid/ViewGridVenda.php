<?php
namespace App\View\Grid;

use App\Core\Grid\Grid;
use App\Core\Grid\GridField;

class ViewGridVenda extends ViewGrid {

    public function __construct(){
        parent::__construct();
        $this->setTitle('Histórico Compra');
    }

    protected function initGrid(Grid $oGrid){
        $oGrid->setPath('gridVenda');
        $oGrid->addField(new GridField('data',          'Data da Venda'));
        //$oGrid->addField(new GridField('quantidade',    'Quantidade'));
        $oGrid->addField(new GridField('datapagamento', 'Data de Pagamento'));
        $oGrid->addField(new GridField('valorpago',     'Valor do pagamento'));
        $oGrid->addField(new GridField('cliente.nome',       'Cliente'));
        $oGrid->addField(new GridField('produto.descricao',       'Produto'));
    }

}
